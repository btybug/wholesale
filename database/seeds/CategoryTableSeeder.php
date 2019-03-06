<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locale='gb';

        $category = new \App\Models\Category(['slug' => 'vape','user_id' => 1]);
        $category->save();
        $category->translateOrNew($locale)->name = 'Vape';
        $category->translateOrNew($locale)->description = '';
        $category->save();

        $category = new \App\Models\Category(['slug' => 'parts','user_id' => 1]);
        $category->save();
        $category->translateOrNew($locale)->name = 'Parts';
        $category->translateOrNew($locale)->description = '';
        $category->save();

        $category = new \App\Models\Category(['slug' => 'juice','user_id' => 1]);
        $category->save();
        $category->translateOrNew($locale)->name = 'Juice';
        $category->translateOrNew($locale)->description = '';
        $category->save();
    }
}
