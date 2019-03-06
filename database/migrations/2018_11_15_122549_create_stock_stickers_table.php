<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_stickers', function (Blueprint $table) {
            $table->unsignedInteger('sticker_id');
            $table->unsignedInteger('stock_id');

            $table->unique(['sticker_id','stock_id']);
            $table->timestamps();

            $table->foreign('sticker_id')->references('id')->on('stickers')->onDelete('cascade');
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
        Schema::dropIfExists('stock_stickers');
    }
}
