<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('from_id')->nullable();
            $table->unsignedInteger('to_id')->nullable();
            $table->unsignedInteger('item_id');
            $table->float('price')->nullable();
            $table->unsignedInteger('qty');
            $table->string('reason')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_history');
    }
}
