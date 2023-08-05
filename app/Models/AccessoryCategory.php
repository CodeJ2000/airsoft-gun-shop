<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryCategory extends Model
{
    use HasFactory;

     // Define the table associated with this model
    protected $table = 'accessory_categories';

     // Define a one-to-many relationship with the AccessoryProduct model
    public function accessoryProduct()
    {
        // This method establishes a one-to-many relationship
        // AccessoryCategory has many AccessoryProduct
        return $this->hasMany(AccessoryProduct::class);
    }
}