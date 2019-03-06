<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RolesTableSeeder::class,
             UsersTableSeeder::class,
             DriveFoldersTableSeeder::class,
             LanguagesTableSeeder::class,
             SiteLanguagesTableSeeder::class,
             EmailsTableSeeder::class,
             CouriersTableSeeder::class,
             DeliveryCostsTypesTableSeeder::class,
             CategoryTableSeeder::class,
             CurrenciesTableSeeder::class,
         ]);
    }
}
