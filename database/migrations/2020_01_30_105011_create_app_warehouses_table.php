<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_warehouses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('warehouse_id')->unique();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('app_warehouses');
    }
}
