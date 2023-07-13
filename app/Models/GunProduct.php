<?php

namespace App\Models;

use App\Models\GunImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GunProduct extends Model
{
    use HasFactory;

    protected $table = "gun_products";
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
        return $this->belongsTo(GunCategory::class);
    }

    public function images()
    {
        return $this->hasMany(GunImage::class);
    }
}