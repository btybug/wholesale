<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->string('type');
            $table->text('url');
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_media');
    }
}
