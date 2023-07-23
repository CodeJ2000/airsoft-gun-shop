<?php

namespace App\Http\Controllers;

use App\Models\AccessoryProduct;
use App\Models\GunProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->shareNavigationData();
    }
    public function index()
    {
        
        Session::put('previous_url', url()->previous());
        $user = Auth::user();
        dd($user);
        $cartItems = $user->cart->cartItems;
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

   
}