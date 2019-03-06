<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('transaction_id');
            $table->integer('amount');
            $table->string('currency_code');
            $table->string('payment_status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stripe_payments');
    }
}
