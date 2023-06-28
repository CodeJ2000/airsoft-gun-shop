<?php

namespace Database\Seeders;

use App\Models\AccessoryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessoryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        AccessoryCategory::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        AccessoryCategory::create(['name' => 'bipod']);
        AccessoryCategory::create(['name' => 'buttstock']);
        AccessoryCategory::create(['name' => 'buffer tube']);
        AccessoryCategory::create(['name' => 'barrel nut']);
        AccessoryCategory::create(['name' => 'airsoft suppressor']);
        AccessoryCategory::create(['name' => 'charging handle']);

    }
}