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
        $this->shareNavigationData();
    }
    public function index(){
        $user = Auth::user();
        if(!$user){
            abort(404);
        }
        $orders = $user->orders;
        return view('order-list', compact('orders'));       
    }
    public function getOrderProducts($orderId)
    {
        $user = Auth::user();
        $order = $user->orders->find($orderId);

        if(!$order){
            return response()->json(['error' => 'Order not found.'], 404);
        }
        $cartItems = $order->cartItems;

        $orderedProducts = [];

        foreach($cartItems as $cartItem){
            $product = $cartItem->productable;
            $image = "storage/product_images/" . $product->images->first()->filename;
            $orderedProducts[] = [
                'filename' => $image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $cartItem->quantity,
                'sub_total' => $cartItem->total_price
            ];
        }
        return response()->json(['products' => $orderedProducts]);
    }
}