<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->unsignedInteger('attributes_id');
            $table->unsignedInteger('sticker_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('attributes_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_attributes');
    }
}
