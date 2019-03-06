<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneCountryRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_country_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('zone_country_id');
            $table->timestamps();

            $table->foreign('zone_country_id')->references('id')->on('zone_countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zone_country_regions');
    }
}
