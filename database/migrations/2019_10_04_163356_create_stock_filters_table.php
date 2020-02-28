<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_filters', function (Blueprint $table) {
            $table->unsignedInteger('stock_id');
            $table->unsignedInteger('categories_id');
            $table->unsignedInteger('parent_id')->nullable();

            $table->unique(['stock_id','categories_id']);
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
        Schema::dropIfExists('stock_filters');
    }
}
