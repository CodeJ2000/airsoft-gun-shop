<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryImage extends Model
{
    use HasFactory;
    // Define the fillable attributes of the model
    protected $fillable = ['filename'];

    // Define a many-to-one relationship with the AccessoryProduct model
    public function product()
    {

        // This method establishes a many-to-one relationship
        // AccessoryImage belongs to AccessoryProduct
        return $this->belongsTo(AccessoryProduct::class);
    }
}