<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStickersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickers_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stickers_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['stickers_id','locale']);
            $table->foreign('stickers_id')->references('id')->on('stickers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stickers_translations');
    }
}
