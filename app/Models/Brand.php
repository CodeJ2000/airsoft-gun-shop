<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function gunProducts()
    {
        return $this->hasMany(GunProduct::class);
    }

    public function accessoryProducts()
    {
        return $this->hasMany(AccessoryProduct::class);
    }
}