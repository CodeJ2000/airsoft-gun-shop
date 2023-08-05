<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    // Define the fillable attributes of the model, which can be mass-assigned
    protected $fillable = [
        'quantity',
        'price',
        'total_price'
    ];

    // Define a many-to-one relationship with the Cart model
    public function cart()
    {

        
        // This method establishes a many-to-one relationship
        // CartItem belongs to a Cart
        return $this->belongsTo(Cart::class);
    }

    // Define a polymorphic relationship with different productable types
    public function productable()
    {
         // This method establishes a polymorphic relationship
        // CartItem can belong to different types of products (morphTo)
        return $this->morphTo();
    }

    // Define a many-to-one relationship with the Order model
    public function orders()
    {
         // This method establishes a many-to-one relationship
        // CartItem belongs to an Order
        return $this->belongsTo(Order::class);
    }
}