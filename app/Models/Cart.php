<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}