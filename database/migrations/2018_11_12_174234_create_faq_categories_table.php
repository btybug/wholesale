<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
//            $table->increments('id');
            $table->unsignedInteger('faq_id');
            $table->unsignedInteger('categories_id');
            $table->unsignedInteger('parent_id')->nullable();

            $table->unique(['faq_id','categories_id']);
            $table->timestamps();

            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_categories');
    }
}
