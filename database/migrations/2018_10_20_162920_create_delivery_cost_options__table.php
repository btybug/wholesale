<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryCostOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_cost_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('courier_id');
            $table->decimal('cost',6,2);
            $table->string('time');
            $table->unsignedInteger('delivery_cost_id');
            $table->timestamps();

            $table->foreign('delivery_cost_id')
                ->references('id')->on('delivery_costs')
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
        Schema::dropIfExists('delivery_cost_options');
    }
}
