<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_items', function (Blueprint $table) {
         $table->unsignedInteger('basket_id');
         $table->unsignedInteger('discount_offer_id')->nullable();
         $table->integer('item_id')->unsigned();
         $table->tinyInteger('type')->default(0);
         $table->unsignedInteger('qty');
         $table->double('price');

         $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
         $table->foreign('discount_offer_id')->references('id')->on('app_offers_discount')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket_items');
    }
}
