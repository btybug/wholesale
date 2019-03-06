<?php

use Illuminate\Database\Seeder;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Couriers::class, 3)->create()->each(function ($courier) {
            $courier->translations()->save(factory(App\Models\Translations\CouriersTranslations::class)->make());
        });
    }
}
