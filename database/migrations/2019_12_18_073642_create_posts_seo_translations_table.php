<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_seo_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seo_posts_id')->unsigned();
            $table->string('locale')->index();
            $table->text('keywords')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->text('fb_title')->nullable();
            $table->text('fb_description')->nullable();
            $table->text('fb_image')->nullable();

            $table->text('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->text('twitter_image')->nullable();
            $table->timestamps();
            $table->unique(['seo_posts_id','locale']);
            $table->foreign('seo_posts_id')->references('id')->on('post_seo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_seo_translations');
    }
}
