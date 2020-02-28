<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainPagesSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_pages_seo_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_pages_seo_id')->unsigned();
            $table->string('locale')->index();
            $table->text('image')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->text('keywords')->nullable();
            $table->unique(['main_pages_seo_id','locale']);
            $table->foreign('main_pages_seo_id')->references('id')->on('main_pages_seo')->onDelete('cascade');
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
        Schema::dropIfExists('main_pages_seo_translations');
    }
}
