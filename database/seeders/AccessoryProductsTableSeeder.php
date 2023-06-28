<?php

namespace Database\Seeders;

use App\Models\AccessoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessoryProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        AccessoryProduct::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        AccessoryProduct::create([
            'name' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider',
            'price' => 1000,
            'description' => 'VFC KAC Type G36 KSK Barrel Extension w/Flash hider
            Metal Construction Airsoft Suppressor
            Come With Muzzle Brake
            Suitable For Umarex (Elite Force) Heckler & Koch G36 series Gas Airsoft Rifles
            Also fit For Most 14mm CCW Thread Airsoft Rifle
            ',
            'brand_id' => 2,
            'category_id' => 2
        ]);
        
        
    }
}