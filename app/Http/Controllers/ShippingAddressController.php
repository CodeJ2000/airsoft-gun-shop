<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    
    public function __construct()
    {
        // Share navigation data with views
        $this->shareNavigationData();        
    }

    // Display the address form view
    public function create()
    {
        return view('address-form');
    }

    // Add or update a shipping address based on user input
    public function addOrUpdateAddress(Request $request)
    {
        // Validate user input using predefined rules
        $validated = $request->validate([
            'street' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'province' => 'required'
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Access the user's cart
        $cart = $user->cart;    

        // Get the shipping address associated with the cart
        $shippingAddress = $cart->shippingAddress;

        // If no shipping address is found, create a new one and associate it with the cart
        if(!$shippingAddress){
            $shippingAddress = new ShippingAddress();
            $cart->shippingAddress()->save($shippingAddress);
        }

        // Fill the shipping address model with the validated user input
        $shippingAddress->fill($validated);

        // Save the changes to the shipping address
        $shippingAddress->save();
 
        // Redirect the user to the cart page with a success message
        return redirect()->route('cart')->with('success', 'Address successfuly set!');
    }
}