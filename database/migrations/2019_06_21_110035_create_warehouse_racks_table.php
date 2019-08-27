<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseRacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_racks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->string('slug',100)->unique()->nullable();
            $table->string('image',255)->nullable();
            $table->timestamps();

            $table->index('parent_id');

            $table->foreign('parent_id')->references('id')
                ->on('categories')->onDelete('CASCADE');
            $table->foreign('warehouse_id')->references('id')
                ->on('warehouses')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_racks');
    }
}
