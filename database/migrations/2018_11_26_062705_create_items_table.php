<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->unsignedInteger('barcode_id');
            $table->string('type',50);
            $table->string('alert',191)->nullable();
            $table->integer('quantity')->default(0);
            $table->text('image');
            $table->decimal('default_price',6,2)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('weight')->nullable();

            $table->decimal('item_length')->nullable();
            $table->decimal('item_width')->nullable();
            $table->decimal('item_height')->nullable();
            $table->decimal('item_weight')->nullable();
            $table->timestamps();
        });

        Schema::table('stock_variations', function (Blueprint $table) {
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
        Schema::dropIfExists('items');
    }
}
