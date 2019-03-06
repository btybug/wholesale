<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('type',20)->nullable();
            $table->string('first_line_address');
            $table->string('second_line_address');
            $table->string('city',50);
            $table->string('country',50);
            $table->string('region',100);
            $table->string('post_code',20);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
