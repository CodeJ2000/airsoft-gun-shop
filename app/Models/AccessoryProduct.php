<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryProduct extends Model
{
    use HasFactory;

    protected $table = 'accessory_products';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}