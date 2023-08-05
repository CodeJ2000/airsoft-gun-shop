<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    // Define the fillable attributes of the model, which can be mass-assigned
    protected $fillable = [
        'street',
        'barangay',
        'city',
        'zip_code',
        'province'
    ];

    // Define a many-to-one relationship with the Cart model
    public function cart()
    {
        // This method establishes a many-to-one relationship
        // ShippingAddress belongs to a Cart
        return $this->belongsTo(Cart::class);
    }
}