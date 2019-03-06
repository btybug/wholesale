<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('code',5);
            $table->string('symbol',10);
            $table->double('rate',8,6)->default(0);
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_currencies');
    }
}
