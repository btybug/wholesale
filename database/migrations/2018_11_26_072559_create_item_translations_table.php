<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->integer('items_id')->unsigned();
            $table->string('locale')->index();
            $table->timestamps();
            $table->unique(['items_id','locale']);
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_translations');
    }
}
