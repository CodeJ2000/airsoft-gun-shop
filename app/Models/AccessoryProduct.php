<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryProduct extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'accessory_products';

    // Define the fillable attributes of the model, which can be mass-assigned
    protected $fillable = [
        'name',
        'price',
        'description',
        'brand_id',
        'category_id',
        'stock'
    ];

     // Define a polymorphic one-to-many relationship with the CartItem model
    public function cartItems()
    {

        // This method establishes a polymorphic one-to-many relationship
        // AccessoryProduct can have many CartItems through productable
        return $this->morphMany(CartItem::class, 'productable');       
    }

    // Define a many-to-one relationship with the Brand model
    public function brand()
    {
        
        // This method establishes a many-to-one relationship
        // AccessoryProduct belongs to a Brand
        return $this->belongsTo(Brand::class);
    }

    // Define a many-to-one relationship with the AccessoryCategory model
    public function category()
    {

        // This method establishes a many-to-one relationship
        // AccessoryProduct belongs to an AccessoryCategory
        return $this->belongsTo(AccessoryCategory::class);
    }

    // Define a one-to-many relationship with the AccessoryImage model
    public function images()
    {   
        // This method establishes a one-to-many relationship
        // AccessoryProduct has many AccessoryImages
        return $this->hasMany(AccessoryImage::class);
    }
}