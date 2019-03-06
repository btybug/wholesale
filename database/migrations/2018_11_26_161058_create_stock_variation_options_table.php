<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockVariationOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_variation_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('variation_id');
            $table->unsignedInteger('attribute_sticker_id');
            $table->timestamps();

            $table->foreign('variation_id')->references('id')->on('stock_variations')->onDelete('cascade');
            $table->foreign('attribute_sticker_id')->references('id')->on('attributes_stickers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_variation_options');
    }
}
