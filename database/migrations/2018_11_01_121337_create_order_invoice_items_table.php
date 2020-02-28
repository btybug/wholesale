<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('stock_id')->nullable();
            $table->string('name');
            $table->string('sku');
            $table->string('variation_id');
            $table->string('type')->nullable();
            $table->float('price');
            $table->integer('qty');
            $table->float('amount');
            $table->string('image')->nullable();
            $table->text('options')->nullable();
            $table->text('note')->nullable();
            $table->text('additional_data')->nullable();
            $table->tinyInteger('collected')->default(0);
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')->on('order_invoices')
                ->onDelete('cascade');

            $table->foreign('parent_id')
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
        Schema::dropIfExists('order_invoice_items');
    }
}
