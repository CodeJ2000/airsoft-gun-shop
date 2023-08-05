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
        // This constructor method is automatically called when an instance of HomeController is created.
        // It calls the shareNavigationData() method, possibly for sharing navigation data across the controller.
        $this->shareNavigationData();
    }
    public function index()
    {
        // Retrieve a random selection of gun products along with their associated brands.
        $guns = GunProduct::with('brand')
                    ->inRandomOrder()
                    ->take(6)
                    ->get();

         // Retrieve a random selection of accessory products along with their associated brands.
        $accessories = AccessoryProduct::with('brand')
                                        ->inRandomOrder()
                                        ->take(6)
                                        ->get();
        
        // Load the 'index' view, passing the retrieved gun and accessory products to it.
        return view('index', ['gun_products' => $guns, 'accessory_products' => $accessories]);
    }
    
}