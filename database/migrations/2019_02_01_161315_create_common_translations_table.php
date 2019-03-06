<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('common_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['common_id','locale']);
            $table->foreign('common_id')->references('id')->on('common')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common');
    }
}
