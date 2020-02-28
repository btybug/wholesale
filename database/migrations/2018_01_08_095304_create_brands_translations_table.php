<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brands_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');
            $table->text('description')->nullable();

            $table->unique(['brands_id','locale']);
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('brands_translations');
    }
}
