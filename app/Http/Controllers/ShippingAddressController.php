<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    
    public function __construct()
    {
        $this->shareNavigationData();        
    }

    public function create()
    {
        return view('address-form');
    }

    public function addOrUpdateAddress(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'province' => 'required'
        ]);

        $user = Auth::user();
        $cart = $user->cart;
        $shippingAddress = $cart->shippingAddress;

        if(!$shippingAddress){
            $shippingAddress = new ShippingAddress();
            $cart->shippingAddress()->save($shippingAddress);
        }
        
        $shippingAddress->fill($validated);
        $shippingAddress->save();
 
        return redirect()->route('cart')->with('success', 'Address successfuly set!');
    }
}