<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attributes_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['attributes_id','locale']);
            $table->foreign('attributes_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes_translations');
    }
}
