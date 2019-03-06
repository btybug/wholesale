<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('stock_id');
            $table->unique(['post_id','stock_id']);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('post_stocks');
    }
}
