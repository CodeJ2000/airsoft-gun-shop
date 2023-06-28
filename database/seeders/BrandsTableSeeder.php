<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Brand::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
        Brand::create(['name' => 'ICS airsoft']);
        Brand::create(['name' => 'tokyo marui']);
        Brand::create(['name' => 'double bell']);
    }
}