<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GunCategory extends Model
{
    use HasFactory;

     // Define the table associated with this model
    protected $table = "gun_categories";

     // Define a one-to-many relationship with the GunProduct model
    public function gunProduct()
    {
         // This method establishes a one-to-many relationship
        // GunCategory has many GunProducts
        return $this->hasMany(GunProduct::class);
    }
}