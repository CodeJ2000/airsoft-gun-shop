<?php

namespace App\Http\Controllers;

use App\Models\AccessoryProduct;
use App\Models\CartItem;
use App\Models\GunProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        
         // Check if the user is authenticated
        if(!$user){
            return redirect()->route('signup.view'); // Redirect to signup page if not logged in
        } else {
            $cart = $user->cart;

            // Validate the incoming request data
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            //get the product_type from input request
            $productType = $request->input('product_type');
            
            //get the model instance depends on the product type
            $productModel = $this->getProductModel($productType);
            
            //get the product that will be add to cart
            $product = $productModel::findOrFail($validated['product_id']);
            
            //for checking the product exist in the cart
            $existingCartItem = $cart->cartItems->where('productable_id', $product->id)
                                                ->where('productable_type', $productModel)->first();
            
            // Check if a null cart item (not associated with an order) already exists for the same product                                    
            $nullItem = $cart->cartItems->where('productable_id', $product->id)
                                                ->where('productable_type', $productModel)
                                                ->where('cart_id', $cart->id)
                                                ->whereNull('order_id')->first();
        
            if($existingCartItem){
                    if($nullItem){

                        // Update the existing cart item's quantity and total price
                        $existingCartItem->quantity += $validated['quantity'];
                        $existingCartItem->total_price = $existingCartItem->quantity * $existingCartItem->price;
                        $existingCartItem->save();
                        return back()->with('success', 'Product is updated to cart.');
                    }else {

                        // Create a new cart item and associate it with the product
                        $cartItem = new CartItem($validated);
                        $cartItem->price = $product->price;
                        $cartItem->total_price = $cartItem->price * $cartItem->quantity;
                        $cartItem->productable()->associate($product);
                        $cart->cartItems()->save($cartItem);
                        return back()->with('success', 'Product added to cart1.');
                    }
            } else {

                // Create a new cart item and associate it with the product
                $cartItem = new CartItem($validated);
                $cartItem->price = $product->price;
                $cartItem->total_price = $cartItem->price * $cartItem->quantity;
                $cartItem->productable()->associate($product);
                $cart->cartItems()->save($cartItem);
                return back()->with('success', 'Product added to cart.');
            }
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
         // Check if the user is authenticated
        if(!$user){
            abort(404); // Abort with a 404 error if the user is not authenticated
        }

        // Find the cart item by ID
        $cartItem = CartItem::find($id);

        // Check if the cart item exists
        if($cartItem){
            $cartItem->delete(); // Delete the cart item
            return redirect()->route('cart')->with('success', 'Successully deleted');
        }

    }


    private function getProductModel($productType)
    {
        // Based on the provided product type, determine and return the appropriate model class
        switch($productType){
            case 'App\Models\GunProduct':
                return GunProduct::class;
            case 'App\Models\AccessoryProduct':
                return AccessoryProduct::class;           
            default:
                throw new \InvalidArgumentException('Invalid product type'); // Throw an exception for an invalid product type
        }
    }
}