<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_bonus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('bonus_bringing_user_id')->nullable();
            $table->unsignedInteger('referral_coupon_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('type');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bonus_bringing_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('referral_coupon_id')->references('id')->on('referal_coupons')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_bonus');
    }
}
