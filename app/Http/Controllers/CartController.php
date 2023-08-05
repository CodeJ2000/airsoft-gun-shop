<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Stripe\StripeClient;
use Illuminate\Http\Request;
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
    
    // Constructor: Initializes the Stripe client and shares navigation data
    public function __construct()
    {
        $this->shareNavigationData();
        $this->stripe = new StripeClient(env('STRIPE_SECRET_KEY')); // Initialize the Stripe client with secret key
    }

    // Index method: Displays cart information for the user
    public function index()
    {
        
        $user = Auth::user(); // Get the authenticated user        
        
        Session::put('previous_url', url()->previous()); // Store the previous URL in the session
        
        // Retrieve cart items for the user that are not yet associated with an order
        $cartItems = $user->cart->cartItems()->whereNull('order_id')->get();

        // Calculate the total price of cart items and format it
        $totalPrice = number_format($cartItems->sum('total_price'), 2, '.', ',');
        
        // Load related productable images for the cart items
        $cartItems->load('productable.images');

        // Retrieve the shipping address for the user's cart
        $address = $user->cart->shippingAddress;

        // If an address is available, format it for display
        $shippingAddress = 'Please provide your shipping address.';

        // Pass the data to the 'cart' view for rendering
        if($address){
            $shippingAddress = ucwords($address->street) . " " . "Brgy. " . ucwords($address->barangay) . " " .  ucwords($address->city) . " " . ucwords($address->province) . " " . ucwords($address->zip_code);
        }

        // Pass the data to the 'cart' view for rendering
        return view('cart', [
            'shippingAddress' => $shippingAddress,
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }

    public function checkout()
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if(!$user){
            throw new NotFoundHttpException(); // Throw an exception if user is not found
        }
        try {
            $cartItems = $user->cart->cartItems;
            $totalPrice = 0;
            $cart = $user->cart->cartItems->whereNull('order_id');

            // Check if the cart is empty
            if($cart->count() < 1){
                return redirect()->route('cart')->with('error', 'Your cart is empty!');
                die; // Exit the function
            } else {

                $shippingAddress = $user->cart->shippingAddress;
                
                // Check if a shipping address is provided
                if(!$shippingAddress){
                    return back()->with('error', 'Please provide your shipping address!');
                    exit(); // Exit the function
                } else {

                    foreach($cartItems as $item){
                        if(!$item->order_id){
                            $totalPrice += $item->total_price;
                            
                            // Create line items for Stripe checkout
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

                    // Create a new Stripe checkout session
                    $checkout_session = $this->stripe->checkout->sessions->create([
                        'line_items' => $this->lineItems,
                        'mode' => 'payment',
                        'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                        'cancel_url' => route('checkout.cancel', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                    ]);
                    
                    // Create a new order in the database
                    $order = new Order();
                    $order->status = 'unpaid';
                    $order->total_price = $totalPrice;
                    $order->session_id = $checkout_session->id;
                    $order->user_id = $user->id;
                    $order->save();

                    // Redirect the user to the Stripe checkout page
                    return redirect($checkout_session->url);
                }
            }
        } catch (AuthenticationException | ApiConnectionException | InvalidRequestException $e) {

            // Handle Stripe-related errors
            return redirect()->back()->with('error', 'Sorry, we are unable to process your payment at the moment. Pleas try agian later');
            
        } catch (Exception $e) {

            // Handle unexpected errors
            return redirect()->back()->with('error', 'An expected error occured. Please try again later');
        }
        
        
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cart->cartItems; // Retrieve cart items for the user
        $sessionId = $request->session_id; // Get the session ID from the request
        try {

            // Retrieve the Stripe session associated with the provided session ID
            $session = $this->stripe->checkout->sessions->retrieve($sessionId);

            // Check if the session is not found
            if(!$session){
                throw new NotFoundHttpException(); // Throw an exception if session is not found
            }

            // Extract customer details from the session
            $customer = $session->customer_details;

            // Find the order associated with the session ID
            $order = Order::where('session_id', $session->id)->first();

            // Check if the order is not found
            if(!$order){
                throw new NotFoundHttpException(); // Throw an exception if order is not found
            }

            // Update order status and associate cart items with the order
            if($order->status === 'unpaid'){
                
                $order->status = 'paid';
                $order->save();

                // Associate cart items with the order
                foreach($cartItems as $item){
                    if(!$item->order_id){
                        $item->order_id = $order->id;
                        $item->save();
                    }
                }
            }
            
            // Return the 'checkout-success' view with customer details
            return view('components.checkout-success', compact('customer'));
        } catch (\Throwable $e) {

             // Throw an exception if an error occurs
            throw new NotFoundHttpException();
        }

    }

    public function cancel(Request $request)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if(!$user){
            throw new NotFoundHttpException();
        }
        try {
            $order = $user->orders;
            $sessionId = $request->session_id;

            // Find the order associated with the session ID and delete it
            $order = $order->where('session_id', $sessionId)->first();
            $order->delete();        
        } catch (\Throwable $e) {
            throw new NotFoundHttpException();
        }
      
        return redirect()->route('cart'); // Redirect to the cart page
    }

    public function webhook()
    {
    // This is your Stripe CLI webhook secret for testing your endpoint locally.
    $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
         // Construct the Stripe event using the payload and signature header
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

        // Find the order associated with the session ID
        $order = Order::where('session_id', $sessionId)->first();
       
        // Update order status to 'paid' if it exists and is unpaid
        if($order && $order->status === 'unpaid'){
            $order->status = 'paid';
            $order->save();

            // Retrieve user's cart and cart items
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