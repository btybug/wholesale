<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('variation_id');
            $table->unsignedInteger('stock_id');
            $table->string('name')->nullable();
            $table->string('slug');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->float('price')->default(0);
            $table->tinyInteger('canceled')->default(0);
            $table->timestamps();

            $table->foreign('variation_id')->references('id')->on('stock_variations')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_sales');
    }
}
