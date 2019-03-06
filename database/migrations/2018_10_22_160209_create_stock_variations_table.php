<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->string('variation_id');
            $table->string('name');
            $table->text('image')->nullable();
            $table->unsignedInteger('qty')->nullable()->default(0);
            $table->float('price')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('stock_variations');
    }
}
