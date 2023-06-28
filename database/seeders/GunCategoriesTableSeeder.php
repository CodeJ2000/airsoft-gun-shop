<?php

namespace Database\Seeders;

use App\Models\GunCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GunCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        GunCategory::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        GunCategory::create(['name' => 'pistols']);
        GunCategory::create(['name' => 'rifles']);
        GunCategory::create(['name' => 'snipers']);
        GunCategory::create(['name' => 'shotguns']);
    }
}