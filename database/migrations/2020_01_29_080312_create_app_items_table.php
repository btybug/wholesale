<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('warehouse_id');
            $table->float('price');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->unique(['warehouse_id', 'item_id']);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_items');
    }
}
