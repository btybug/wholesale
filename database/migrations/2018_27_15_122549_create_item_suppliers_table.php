<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_suppliers', function (Blueprint $table) {
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('supplier_id');

            $table->unique(['item_id','supplier_id']);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_suppliers');
    }
}
