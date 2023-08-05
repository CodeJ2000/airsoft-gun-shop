<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        
        // Initialize an empty array to store all orders
        $allOrders = [];
        
        // Initialize a variable to keep track of the total order price
        $total = 0;

        // Retrieve all orders from the database, including their 'id', 'status', 'total_price', and 'user_id'
        $orders = Order::select('id', 'status', 'total_price', 'user_id')->get();

         // Retrieve all customers from the database, including their 'first_name', 'last_name', 'email', and 'user'
        $users = User::select('first_name', 'last_name', 'email', 'user')->where('user', '=', 'customer')->get();

        // If there are no customers, set $users to 0 (to prevent null issues later)
        if(!$users){
            $users = 0; 
        }

        // Loop through each order
        foreach($orders as $order){

            // Increment the total price with the current order's total price
            $total += $order->total_price;

            // Find the user associated with the current order
            $user = User::find($order->user_id);

            // Create a full user name by concatenating first name and last name
            $userName = $user->first_name . " " . $user->last_name;

            // Get the shipping address from the user's cart
            $address = $user->cart->shippingAddress;

            $shippingAddress = $address->street . " Brgy." . $address->barangay . " " . $address->city . " " . $address->province . " " . $address->zip_code;

            // Add the details of the current order to the $allOrders array
            $allOrders[] = (object)[
                'shipping_address' => ucwords($shippingAddress),
                'total_price' => number_format($order->total_price),
                'payment_status' => $order->status,
                'customer_name' => $userName,
                'order_id' => $order->id,
            ];
        }

        // Convert the $allOrders array into an object
        $allOrders = json_decode(json_encode($allOrders));

        // Pass the relevant data to the 'admin.index' view
        return view('admin.index', ['allOrders' => $allOrders, 'users' => $users, 'total' => number_format($total)]);
    }
}