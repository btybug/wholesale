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
            $table->unsignedInteger('item_id');
            $table->string('variation_id');
            $table->string('type');
            $table->string('title')->nullable();
            $table->tinyInteger('is_required')->default(0);
            $table->string('name');
            $table->text('image')->nullable();
            $table->unsignedInteger('qty')->default(0);
            $table->float('price')->default(0);
            $table->unsignedInteger('count_limit')->default(0);
            $table->unsignedInteger('min_count_limit')->default(0);
            $table->unsignedInteger('common_price')->default(0);
            $table->string('display_as')->nullable();
            $table->string('price_per')->nullable();
            $table->unsignedInteger('filter_category_id');
            $table->string('price_type')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('ordering')->default(0);
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
