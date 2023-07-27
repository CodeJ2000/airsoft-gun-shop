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
        if(!$user){
            return redirect()->route('signup.view');
        } else {
            $cart = $user->cart;

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
        $nullItem = $cart->cartItems->where('productable_id', $product->id)
                                            ->where('productable_type', $productModel)
                                            ->where('cart_id', $cart->id)
                                            ->whereNull('order_id')->first();
     
        if($existingCartItem){
                if($nullItem){
                    $existingCartItem->quantity += $validated['quantity'];
                    $existingCartItem->total_price = $existingCartItem->quantity * $existingCartItem->price;
                    $existingCartItem->save();
                    return back()->with('success', 'Product is updated to cart.');
                }else {
                    $cartItem = new CartItem($validated);
                    $cartItem->price = $product->price;
                    $cartItem->total_price = $cartItem->price * $cartItem->quantity;
                    $cartItem->productable()->associate($product);
                    $cart->cartItems()->save($cartItem);
                    return back()->with('success', 'Product added to cart1.');
                }
        } else {
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

        if(!$user){
            abort(404);
        }
        $cartItem = CartItem::find($id);

        if($cartItem){
            $cartItem->delete();
            return redirect()->route('cart')->with('success', 'Successully deleted');
        }

    }

    private function getProductModel($productType)
    {
        switch($productType){
            case 'App\Models\GunProduct':
                return GunProduct::class;
            case 'App\Models\AccessoryProduct':
                return AccessoryProduct::class;           
            default:
                throw new \InvalidArgumentException('Invalid product type');
        }
    }
}