<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->string('name');
            $table->string('type');
            $table->text('content');
            $table->timestamps();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_seo');
    }
}
