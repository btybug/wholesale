<?php

use Illuminate\Database\Seeder;

class SiteLanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_languages')->insert([
            [
                'name' =>'United Kingdom',
                'original_name'=>'United Kingdom',
                'code'=>'GB',
                'direction' =>'ltr',
                'default' =>1,
                'shared' =>1,
            ]
        ]);
    }
}
