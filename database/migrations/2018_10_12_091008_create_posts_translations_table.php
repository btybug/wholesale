<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('posts_id')->unsigned();
            $table->string('url')->nullable();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->unique(['posts_id','locale']);
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_translations');
    }
}
