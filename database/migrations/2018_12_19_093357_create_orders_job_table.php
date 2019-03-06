<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_job', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('order_id');
            $table->timestamp('sent_at')->nullable();
            $table->text('log')->nullable();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_job');
    }
}
