<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('from_id');
            $table->unsignedInteger('to_id');
            $table->tinyInteger('qty')->default(0);
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
//            $table->foreign('from_id')->references('id')->on('item_locations')->onDelete('cascade');
//            $table->foreign('to_id')->references('id')->on('item_locations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_transfers');
    }
}
