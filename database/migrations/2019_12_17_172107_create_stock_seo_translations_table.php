<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_seo_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_seo_id')->unsigned();
            $table->string('locale')->index();
            $table->text('keywords')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();

            $table->text('fb_title')->nullable();
            $table->text('fb_description')->nullable();
            $table->text('fb_image');

            $table->text('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->text('twitter_image')->nullable();
            $table->timestamps();
            $table->unique(['stock_seo_id', 'locale']);
            $table->foreign('stock_seo_id')->references('id')->on('stock_seo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_seo_translations');
    }
}
