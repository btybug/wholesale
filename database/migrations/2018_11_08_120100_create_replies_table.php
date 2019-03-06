<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('author_id')->nullable()->unsigned();
            $table->longText('reply');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('CASCADE');

            $table->foreign('parent_id')
                ->references('id')
                ->on('replies')
                ->onDelete('CASCADE');

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
