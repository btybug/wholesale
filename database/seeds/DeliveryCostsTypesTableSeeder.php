<?php

use Illuminate\Database\Seeder;

class DeliveryCostsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_cost_types')->insert([
            [
                'title' => 'Based on Order amount',
            ], [
                'title' => 'Based on weight',
            ]]
        );
    }
}
