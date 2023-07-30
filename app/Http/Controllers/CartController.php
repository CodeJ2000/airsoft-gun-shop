<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Mockery\Matcher\Not;
use Stripe\StripeClient;
use App\Models\GunProduct;
use Illuminate\Http\Request;
use App\Models\AccessoryProduct;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\OAuth\InvalidRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    protected $stripe;
    protected $lineItems = [];
    public function __construct()
    {
        $this->shareNavigationData();
        $this->stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

    }
    public function index()
    {
        $user = Auth::user();        
        Session::put('previous_url', url()->previous());
        $cartItems = $user->cart->cartItems()->whereNull('order_id')->get();
        $totalPrice = number_format($cartItems->sum('total_price'), 2, '.', ',');
        
        $cartItems->load('productable.images');
        $address = $user->cart->shippingAddress;
        $shippingAddress = 'Please provide your shipping address.';
        if($address){
            $shippingAddress = ucwords($address->street) . " " . "Brgy. " . ucwords($address->barangay) . " " .  ucwords($address->city) . " " . ucwords($address->province) . " " . ucwords($address->zip_code);
        }
        return view('cart', [
            'shippingAddress' => $shippingAddress,
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }

    public function checkout()
    {
        $user = Auth::user();
        if(!$user){
            throw new NotFoundHttpException();
        }
        try {
            $cartItems = $user->cart->cartItems;
            $totalPrice = 0;
            $cart = $user->cart->cartItems->whereNull('order_id');
            if($cart->count() < 1){
                return redirect()->route('cart')->with('error', 'Your cart is empty!');
                die;
            } else {
                $shippingAddress = $user->cart->shippingAddress;
                if(!$shippingAddress){
                    return back()->with('error', 'Please provide your shipping address!');
                    exit();
                } else {
                    foreach($cartItems as $item){
                        if(!$item->order_id){
                            $totalPrice += $item->productable->price;
                            $this->lineItems[] = [
                                'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => $item->productable->name,
                                ],
                                'unit_amount' => $item->productable->price * 100,
                                ],
                                'quantity' => $item->quantity,
                            ];
                        }
                    }
                    $checkout_session = $this->stripe->checkout->sessions->create([
                        'line_items' => $this->lineItems,
                        'mode' => 'payment',
                        'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                        'cancel_url' => route('checkout.cancel', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                    ]);
            
                    $order = new Order();
                    $order->status = 'unpaid';
                    $order->total_price = $totalPrice;
                    $order->session_id = $checkout_session->id;
                    $order->user_id = $user->id;
                    $order->save();

                    return redirect($checkout_session->url);
                }
            }
        } catch (AuthenticationException | ApiConnectionException | InvalidRequestException $e) {

            return redirect()->back()->with('error', 'Sorry, we are unable to process your payment at the moment. Pleas try agian later');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An expected error occured. Please try again later');
        }
        
        
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cart->cartItems;
        $sessionId = $request->session_id;
        try {
            $session = $this->stripe->checkout->sessions->retrieve($sessionId);
            if(!$session){
                throw new NotFoundHttpException();
            }
            $customer = $session->customer_details;
            $order = Order::where('session_id', $session->id)->first();

            if(!$order){
                throw new NotFoundHttpException();
            }
            if($order->status === 'unpaid'){
                $order->status = 'paid';
                $order->save();
                foreach($cartItems as $item){
                    if(!$item->order_id){
                        $item->order_id = $order->id;
                        $item->save();
                    }
                }
            }
        
            return view('components.checkout-success', compact('customer'));
        } catch (\Throwable $e) {
            throw new NotFoundHttpException();
        }

    }

    public function cancel(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            throw new NotFoundHttpException();
        }
        try {
            $order = $user->orders;
            $sessionId = $request->session_id;
            $order = $order->where('session_id', $sessionId)->first();
            $order->delete();        
        } catch (\Throwable $e) {
            throw new NotFoundHttpException();
        }
      
        return redirect()->route('cart');
    }

    public function webhook()
    {
    // This is your Stripe CLI webhook secret for testing your endpoint locally.
    $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
    } catch(\UnexpectedValueException $e) {
    // Invalid payload
    return response('', 400);
    } catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    return response('', 400);
    }

    // Handle the event
    switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;
        $sessionId = $session->id;
        $order = Order::where('session_id', $sessionId)->first();
        if($order && $order->status === 'unpaid'){
            $order->status = 'paid';
            $order->save();
            $user = Auth::user();
            $user->cart->cartItems;
            //send email to the customer
        }
    // ... handle other event types
    default:
        echo 'Received unknown event type ' . $event->type;
    }

    return response('');
    }

}