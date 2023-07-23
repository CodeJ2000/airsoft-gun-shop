<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function shareNavigationData()
    {
        $gunCategory = DB::table('gun_categories')
                            ->get();
        $accessoryCategory = DB::table('accessory_categories')
                                ->get();
        
        View::share([
            'guns' => $gunCategory, 
            'accessories' => $accessoryCategory, 
        ]);
    }
}