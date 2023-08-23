<?php

namespace App\Models;

use App\Models\Image;
use App\Models\GunImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GunProduct extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = "gun_products";

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
        // GunProduct can have many CartItems through productable
        return $this->morphMany(CartItem::class, 'productable');       
    }

    // Define a many-to-one relationship with the Brand model
    public function brand()
    {
        // This method establishes a many-to-one relationship
        // GunProduct belongs to a Brand
        return $this->belongsTo(Brand::class);
    }

    // Define a many-to-one relationship with the GunCategory model
    public function category()
    {
        // This method establishes a many-to-one relationship
        // GunProduct belongs to a GunCategory
        return $this->belongsTo(GunCategory::class);
    }

    // This method establishes a many-to-one relationship
        // GunProduct belongs to a GunCategory
    public function images()
    {
        // This method establishes a one-to-many relationship
        // GunProduct has many GunImages
        return $this->hasMany(GunImage::class);
    }
}