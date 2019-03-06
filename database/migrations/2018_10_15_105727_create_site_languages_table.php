<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('original_name')->nullable();
            $table->string('code')->unique();
            $table->string('direction');
            $table->integer('default')->default(0);
            $table->integer('shared')->default(0);
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
        Schema::dropIfExists('site_languages');
    }
}
