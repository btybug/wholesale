<?php

use Illuminate\Database\Seeder;

class TaxRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TaxRates::class, 3)->create()->each(function ($courier) {
            $courier->translations()->save(factory(App\Models\Translations\TaxRateTranslation::class)->make());
        });
    }
}
