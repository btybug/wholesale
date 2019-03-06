<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->string('object');
            $table->decimal('amount',6,2);
            $table->decimal('amount_refunded',6,2);
            $table->string('currency',3);
            $table->text('invoice')->nullable();
            $table->tinyInteger('paid');
            $table->string('receipt_number')->nullable();
            $table->string('receipt_url');
            $table->string('refunds_url');
            $table->string('source_id');
            $table->string('source_object',20);
            $table->string('source_brand',20);
            $table->string('source_country',5);
            $table->string('source_exp_month',2);
            $table->string('source_exp_year',4);
            $table->string('source_funding',20);
            $table->string('source_last4',4);
            $table->string('status');


            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
