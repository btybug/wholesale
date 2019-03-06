<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('based_on');
            $table->unsignedInteger('stock_id')->nullable();
            $table->unsignedInteger('stock_count')->nullable();
            $table->unsignedInteger('cart_amount')->nullable();
            $table->string('promo_code',50)->nullable();
            $table->unsignedInteger('free_juices_count');
            $table->string('choice_type');

            $table->timestamps();

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
        Schema::dropIfExists('gifts');
    }
}
