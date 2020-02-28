<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_stickers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('sticker_id');

            $table->unique(['sticker_id','brand_id']);

            $table->foreign('sticker_id')->references('id')->on('stickers')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('brand_stickers');
    }
}
