<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    // Include the SoftDeletes trait to enable soft delete functionality
    use SoftDeletes;

    // Define a one-to-many relationship with the GunProduct model
    public function gunProducts()
    {

        // This method establishes a one-to-many relationship
        // Brand has many GunProducts
        return $this->hasMany(GunProduct::class);
    }

    // Define a one-to-many relationship with the AccessoryProduct model
    public function accessoryProducts()
    {
        // This method establishes a one-to-many relationship
        // Brand has many AccessoryProducts
        return $this->hasMany(AccessoryProduct::class);
    }
}