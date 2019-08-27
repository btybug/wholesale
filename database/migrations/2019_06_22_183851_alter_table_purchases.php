<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->unsignedInteger('rack_id')->nullable();
            $table->unsignedInteger('shelve_id')->nullable();

//            $table->foreign('warehouse_id')->references('id')
//                ->on('warehouses')->onDelete('CASCADE');

//            $table->foreign('rack_id')->references('id')
//                ->on('warehouse_racks')->onDelete('CASCADE');
//
//            $table->foreign('shelve_id')->references('id')
//                ->on('warehouse_racks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
        });
    }
}
