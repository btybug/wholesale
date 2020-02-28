<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->text('what_is_content')->nullable();

            $table->unique(['stock_id','locale']);
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
        Schema::dropIfExists('stock_translations');
    }
}
