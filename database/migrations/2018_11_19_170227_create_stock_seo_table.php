<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->tinyInteger('robots')->nullable();
            $table->tinyInteger('robots_follow')->nullable();
            $table->text('meta_robots_advanced')->nullable();
            $table->text('canonical_url')->nullable();
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
        Schema::dropIfExists('stock_seo');
    }
}
