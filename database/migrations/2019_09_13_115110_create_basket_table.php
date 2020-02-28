<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id');
            $table->tinyInteger('status')->default(0);
            $table->string('order_number');
            $table->integer('user_id')->unsigned()->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedBigInteger('admin_discount_id')->nullable();
            $table->text('additional_data')->nullable();
            $table->text('note')->nullable();
            $table->string('payment_method');
            $table->double('tendered')->nullable();
            $table->double('changed')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total')->nullable();
            $table->double('tax')->nullable();
            $table->double('admin_discount')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
            $table->foreign('admin_discount_id')->references('id')->on('discounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket');
    }
}
