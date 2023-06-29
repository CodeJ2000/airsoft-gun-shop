<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function shareNavigationData()
    {
        $gunCategory = DB::table('gun_categories')
                            ->get();
        $accessoryCategory = DB::table('accessory_categories')
                                ->get();
        View::share(['guns' => $gunCategory, 'accessories' => $accessoryCategory]);
    }
}