<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInvoiceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_invoice_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->string('type',20)->nullable();
            $table->string('first_line_address');
            $table->string('second_line_address');
            $table->string('city',50);
            $table->string('country',50);
            $table->string('region',100);
            $table->string('post_code',20);
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')->on('order_invoices')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_invoice_addresses');
    }
}
