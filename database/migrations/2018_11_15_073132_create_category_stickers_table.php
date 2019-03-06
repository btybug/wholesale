<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_stickers', function (Blueprint $table) {
            $table->unsignedInteger('sticker_id');
            $table->unsignedInteger('categories_id');

            $table->unique(['sticker_id','categories_id']);
            $table->timestamps();

            $table->foreign('sticker_id')->references('id')->on('stickers')->onDelete('cascade');
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
        Schema::dropIfExists('category_stickers');
    }
}
