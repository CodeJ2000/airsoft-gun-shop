<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define a one-to-one relationship with the Cart model
    public function cart()
    {
        // This method establishes a one-to-one relationship
        // User has one Cart
        return $this->hasOne(Cart::class);
    }

    // Define a one-to-many relationship with the Order model
    public function orders()
    {
        // This method establishes a one-to-many relationship
        // User has many Orders
        return $this->hasMany(Order::class);
    }

    // Define a custom method to check if the user is a customer
    public function isCustomer()
    {
        // This method returns whether the user's role is 'customer'
        return $this->user === 'customer';
    }
}