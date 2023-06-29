<?php

namespace App\Http\Controllers;

use App\Models\AccessoryProduct;
use App\Models\GunProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->shareNavigationData();
    }
    public function index()
    {
        $guns = GunProduct::with('brand')
                    ->inRandomOrder()
                    ->take(6)
                    ->get();
        $accessories = AccessoryProduct::with('brand')
                                        ->inRandomOrder()
                                        ->take(6)
                                        ->get();
        return view('index', ['gun_products' => $guns, 'accessory_products' => $accessories]);
    }
    
}