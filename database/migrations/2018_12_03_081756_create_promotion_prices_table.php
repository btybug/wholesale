<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('variation_id');
            $table->unsignedInteger('promotion_id');
            $table->float('price')->default(0);
            $table->timestamps();

            $table->foreign('variation_id')->references('id')->on('stock_variations')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_prices');
    }
}
