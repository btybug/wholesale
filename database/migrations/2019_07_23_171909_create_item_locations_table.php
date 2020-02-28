<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_locations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('rack_id')->nullable();
            $table->unsignedInteger('shelve_id')->nullable();
            $table->integer('qty')->nullable();

            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_locations');
    }
}
