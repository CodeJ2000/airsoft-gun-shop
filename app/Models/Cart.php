<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Define a one-to-one relationship with the ShippingAddress model
    public function shippingAddress()
    {
        // This method establishes a one-to-one relationship
        // Cart has one ShippingAddress
        return $this->hasOne(ShippingAddress::class);
    }

    // Define a one-to-many relationship with the CartItem model
    public function cartItems()
    {
        // This method establishes a one-to-many relationship
        // Cart has many CartItems
        return $this->hasMany(CartItem::class);
    }
}