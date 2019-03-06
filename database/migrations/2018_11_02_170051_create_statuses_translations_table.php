<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('statuses_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['statuses_id','locale']);
            $table->timestamps();
            $table->foreign('statuses_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses_translations');
    }
}
