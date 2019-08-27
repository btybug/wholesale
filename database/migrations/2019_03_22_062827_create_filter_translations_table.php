<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_child_label')->nullable();
            $table->integer('filters_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['filters_id','locale']);
            $table->foreign('filters_id')->references('id')->on('filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_translations');
    }
}
