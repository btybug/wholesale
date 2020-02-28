<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('slug',100)->unique()->nullable();
            $table->string('image',255)->nullable();
            $table->string('icon',255)->nullable();
            $table->string('classes',255)->nullable();
            $table->string('type',100)->default('stocks');
            $table->tinyInteger('is_core')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->index('parent_id');
            $table->index('user_id');


            $table->foreign('parent_id')->references('id')
                ->on('categories')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
