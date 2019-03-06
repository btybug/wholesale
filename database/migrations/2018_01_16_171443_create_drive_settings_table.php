<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriveSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drive_settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('function')->nullable();
            $table->string('slug')->nullable();
            $table->integer('folder_id')->unsigned();
            $table->string('action')->default('all_access');
            $table->text('uploader_data')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('folder_id')
                ->references('id')->on('drive_folders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drive_settings');
    }
}
