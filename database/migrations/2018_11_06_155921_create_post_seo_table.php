<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->string('name');
            $table->string('type');
            $table->text('content');
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_seo');
    }
}
