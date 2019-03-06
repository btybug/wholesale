<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_stickers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attributes_id');
            $table->unsignedInteger('sticker_id');
            $table->unique(['sticker_id','attributes_id']);
            $table->timestamps();

            $table->foreign('attributes_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('sticker_id')->references('id')->on('stickers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_stickers');
    }
}
