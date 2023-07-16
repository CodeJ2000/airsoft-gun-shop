<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryProduct extends Model
{
    use HasFactory;

    protected $table = 'accessory_products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'brand_id',
        'category_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(AccessoryCategory::class);
    }

    public function images()
    {
        return $this->hasMany(AccessoryImage::class);
    }
}