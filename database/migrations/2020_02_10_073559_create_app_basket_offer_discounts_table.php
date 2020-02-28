<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppBasketOfferDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_basket_offer_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('discount_offer_id');
            $table->unsignedBigInteger('basket_id');
            $table->timestamps();
            $table->foreign('discount_offer_id')->references('id')->on('app_offers_discount')->onDelete('set null');
            $table->foreign('basket_id')->references('id')->on('basket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_basket_offer_discounts');
    }
}
