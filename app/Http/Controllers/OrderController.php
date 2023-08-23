<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    public function __construct()
    {
        // This constructor method is automatically called when an instance of OrderController is created.
        // It calls the shareNavigationData() method, for sharing navigation data across the controller.
        $this->shareNavigationData();
    }
    public function index(){
        // Retrieve the currently authenticated user.
        $user = Auth::user();

        // Check if a user is authenticated, and if not, return a 404 error page.
        if(!$user){
            abort(404);
        }

        // Retrieve orders associated with the authenticated user.
        $orders = $user->orders;

         // Load the 'order-list' view, passing the retrieved orders to it.
        return view('order-list', compact('orders'));       
    }
    public function getOrderProducts($orderId)
    {
         // Retrieve the currently authenticated user.
        $user = Auth::user();

        // Find the order associated with the provided order ID within the authenticated user's orders.
        $order = $user->orders->find($orderId);

         // If the order doesn't exist, return a JSON response with a 404 error.
        if(!$order){
            return response()->json(['error' => 'Order not found.'], 404);
        }

        // Retrieve cart items (products) associated with the found order.
        $cartItems = $order->cartItems;

        // Initialize an array to store details about ordered products.
        $orderedProducts = [];


         // Loop through each cart item to gather information about the ordered products.
        foreach($cartItems as $cartItem){

            $product = $cartItem->productable;
            $image = "storage/product_images/" . $product->images->first()->filename;
            
            // Build an array with details about the ordered product.
            $orderedProducts[] = [
                'filename' => $image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $cartItem->quantity,
                'sub_total' => $cartItem->total_price
            ];
        }
        
        // Return a JSON response containing information about the ordered products.
        return response()->json(['products' => $orderedProducts]);
    }
}