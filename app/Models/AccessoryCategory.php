<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryCategory extends Model
{
    use HasFactory;

    protected $table = 'accessory_categories';

    public function accessoryProduct()
    {
        return $this->hasMany(AccessoryProduct::class);
    }
}