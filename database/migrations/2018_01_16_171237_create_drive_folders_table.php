<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriveFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drive_folders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->index('drive_folders_name');
            $table->string('prefix')->nullable();
            $table->integer('parent_id')->unsigned();
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
        Schema::dropIfExists('drive_folders');
    }
}
