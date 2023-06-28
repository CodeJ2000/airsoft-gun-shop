<?php

namespace Database\Seeders;

use App\Models\GunProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GunProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        GunProduct::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
        GunProduct::create([
            'name' => 'Snow Wolf SV-98 Bolt Action Sniper Rifle with Bipod & Scope (OD/ SW025)',
            'brand_id' => 1,
            'price' => 2000,
            'category_id' => 1,
            'description' => 'The real steel SV-98 is a Russian made sniper rifle designed by Valdimir Stronskiy in 1998 and was first seen used by Russian special forces in 2003 during the Chechen Wars. This sniper rifle is now being adopted by the various branches of the Russian military and law enforcements alike. The notable users are the FSB, FSO and the National Guard of Russia.'
        ]);
    }
}