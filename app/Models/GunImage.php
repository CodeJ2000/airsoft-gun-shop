<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GunImage extends Model
{
    use HasFactory;
    protected $fillable = ['filename'];
    public function product()
    {
        return $this->belongsTo(GunProduct::class); 
    }
}