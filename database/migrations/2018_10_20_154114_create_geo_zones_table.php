<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_zones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tax_rate_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('payment_options');
            $table->timestamps();

            $table->foreign('tax_rate_id')
                ->references('id')->on('tax_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_zones');
    }
}
