<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('couriers_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['couriers_id','locale']);
            $table->foreign('couriers_id')->references('id')->on('couriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_translations');
    }
}
