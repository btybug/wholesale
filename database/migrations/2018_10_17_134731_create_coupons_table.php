<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('type')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('shipping_type')->nullable();
            $table->unsignedInteger('product')->nullable();
            $table->string('variations')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('user_per_coupon')->nullable();
            $table->string('user_per_customer')->nullable();
            $table->string('based')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('target')->default(0);
            $table->string('users')->nullable();
            $table->string('created_by')->nullable();
            $table->string('theme')->nullable();
            $table->tinyInteger('send_email')->default(0);
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
        Schema::dropIfExists('coupons');
    }
}
