<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->integer('qty');
            $table->string('reason');
            $table->text('notes')->nullable();
            $table->string('grouped');
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('parent_id')->references('id')->on('others')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('others');
    }
}
