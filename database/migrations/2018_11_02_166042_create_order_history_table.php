<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_history');
    }
}
