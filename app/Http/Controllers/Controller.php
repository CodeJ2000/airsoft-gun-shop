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
        // Retrieve gun categories from the 'gun_categories' table using the DB facade.
        $gunCategory = DB::table('gun_categories')
                            ->get();

        // Retrieve accessory categories from the 'accessory_categories' table using the DB facade.
        $accessoryCategory = DB::table('accessory_categories')
                                ->get();
        // Share retrieved categories with all views across the application.
        View::share([
            'guns' => $gunCategory, // Make gun categories available to views.
            'accessories' => $accessoryCategory, // Make accessory categories available to views.
        ]);
    }
}