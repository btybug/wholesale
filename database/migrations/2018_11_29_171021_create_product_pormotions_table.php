<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPormotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->unsignedInteger('promotion_id');
            $table->tinyInteger('type')->default(0);
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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
        Schema::dropIfExists('product_promotions');
    }
}
