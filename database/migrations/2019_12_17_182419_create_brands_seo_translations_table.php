<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_seo_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brands_seo_id')->unsigned();
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

            $table->unique(['brands_seo_id','locale']);
            $table->foreign('brands_seo_id')->references('id')->on('brands_seo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands_seo_translations');
    }
}
