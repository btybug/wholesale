<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_query', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gift_id');
            $table->string('column',100);
            $table->string('condition',2);
            $table->string('needle',100);
            $table->timestamps();

            $table->foreign('gift_id')->references('id')->on('gifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_query');
    }
}
