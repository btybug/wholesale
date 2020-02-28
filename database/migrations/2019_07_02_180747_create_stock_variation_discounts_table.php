<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockVariationDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_variation_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('variation_id');
            $table->double('price')->nullable();
            $table->unsignedInteger('qty')->nullable();
            $table->unsignedInteger('from')->nullable();
            $table->unsignedInteger('to')->nullable();
            $table->unsignedInteger('ordering')->nullable();
            $table->timestamps();

            $table->foreign('variation_id')->references('id')->on('stock_variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_variation_discounts');
    }
}
