<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [

            'title' =>'Super Admin',
            'slug'=>'superadmin',
            'type'=>'backend',
            'description' =>'this role can all'
        ],[

            'title' =>'Customer',
            'slug'=>'customer',
            'type'=>'frontend',
            'description' =>'this role can all'
        ]
        ]);
    }
}
