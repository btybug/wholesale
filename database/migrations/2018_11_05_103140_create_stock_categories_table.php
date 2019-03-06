<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_categories', function (Blueprint $table) {
//            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->unsignedInteger('categories_id');
            $table->unsignedInteger('parent_id')->nullable();

            $table->unique(['stock_id','categories_id']);
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_categories');
    }
}
