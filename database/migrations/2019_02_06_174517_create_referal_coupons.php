<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferalCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('coupon_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referal_coupons');
    }
}
