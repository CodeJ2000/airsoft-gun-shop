<?php

namespace App\Http\Controllers;

use App\Models\AccessoryProduct;
use App\Models\GunProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Matcher\Not;
use Stripe\StripeClient;
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
        $cartItems = $user->cart->cartItems;
        $totalPrice = 0;
        $cart = $user->cart->cartItems->whereNull('order_id');
        if($cart->count() < 1){
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
            die;
        } else{
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
                'cancel_url' => route('checkout.cancel', [], true),
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

    public function cancel()
    {

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