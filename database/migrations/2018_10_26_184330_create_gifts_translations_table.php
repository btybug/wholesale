<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gifts_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique(['gifts_id','locale']);
            $table->foreign('gifts_id')->references('id')->on('gifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gifts_translations');
    }
}
