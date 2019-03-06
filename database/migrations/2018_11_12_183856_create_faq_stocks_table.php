<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faq_id');
            $table->unsignedInteger('stock_id');
            $table->unique(['faq_id','stock_id']);
            $table->timestamps();

            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_stocks');
    }
}
