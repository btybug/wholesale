<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('min');
            $table->unsignedInteger('max');
            $table->unsignedInteger('geo_zone_id');
            $table->unsignedInteger('delivery_cost_types_id');
            $table->timestamps();

            $table->foreign('delivery_cost_types_id')
                ->references('id')->on('delivery_cost_types')
                ->onDelete('cascade');
            $table->foreign('geo_zone_id')
                ->references('id')->on('geo_zones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_costs');
    }
}
