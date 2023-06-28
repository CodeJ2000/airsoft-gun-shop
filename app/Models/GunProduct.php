<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GunProduct extends Model
{
    use HasFactory;

    protected $table = "gun_products";

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}