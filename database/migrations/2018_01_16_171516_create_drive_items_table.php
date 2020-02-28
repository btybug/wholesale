<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriveItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drive_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('original_name')
                ->index('drive_items_original_name');
            $table->string('real_name')
                ->index('drive_items_real_name');
            $table->string('extension')
                ->index('drive_items_extension');
            $table->string('size');
            $table->string('original_folder');
            $table->integer('folder_id')->unsigned();

            $table->string('seo_keywords')->nullable();
            $table->string('seo_caption')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_alt')->nullable();

            $table->timestamps();
            $table->foreign('folder_id')
                ->references('id')
                ->on('drive_folders')
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
        Schema::dropIfExists('drive_items');
    }
}
