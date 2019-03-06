<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('priority_id');
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->string('subject');
            $table->text('summary');
            $table->text('tags')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('priority_id')->references('id')->on('statuses');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('staff_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('stocks');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
