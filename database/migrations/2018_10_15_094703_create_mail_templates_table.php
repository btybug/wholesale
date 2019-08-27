<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('from');
            $table->string('to')->nullable();
            $table->string('cc')->nullable();
            $table->string('module')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->unsignedInteger('category_id')->nullable();
            $table->tinyInteger('is_for_admin')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_templates');
    }
}
