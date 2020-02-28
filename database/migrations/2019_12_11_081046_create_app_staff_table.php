<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('warehouses_id')->unsigned();
            $table->timestamps();

//            $table->foreign('warehouses_id')->references('id')->on('warehouses')->onDelete('cascade');
//            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_staff');
    }
}
