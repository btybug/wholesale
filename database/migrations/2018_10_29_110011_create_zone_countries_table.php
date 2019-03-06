<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->tinyInteger('all')->default(1);
            $table->unsignedInteger('geo_zone_id');
            $table->unique(['geo_zone_id','name']);
            $table->timestamps();

            $table->foreign('geo_zone_id')->references('id')->on('geo_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zone_countries');
    }
}
