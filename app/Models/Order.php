<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define a one-to-many relationship with the CartItem model
    public function cartItems()
    {
        // This method establishes a one-to-many relationship
        // Order has many CartItems
        return $this->hasMany(CartItem::class);
    }

    // Define a many-to-one relationship with the User model
    public function user()
    {
        // This method establishes a many-to-one relationship
        // Order belongs to a User
        return $this->belongsTo(User::class);
    }

    // Define an accessor to get the formatted 'created_at' attribute
    public function getFormattedCreatedAttribute()
    {
        // This method uses Carbon library to format the 'created_at' timestamp
        // Returns the formatted date and time (e.g., "January 01, 2023 12:00 PM")
        return Carbon::parse($this->created_at)->format('F d, Y h:i A');
    }
}