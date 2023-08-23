<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GunImage extends Model
{
    use HasFactory;
    // Define the fillable attributes of the model, which can be mass-assigned
    protected $fillable = ['filename'];

     // Define a many-to-one relationship with the GunProduct model
    public function product()
    {
        // This method establishes a many-to-one relationship
        // GunImage belongs to a GunProduct
        return $this->belongsTo(GunProduct::class); 
    }
}