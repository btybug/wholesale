<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_us_id');
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('is_readed')->default(0);
            $table->timestamps();

            $table->foreign('contact_us_id')->references('id')->on('contact_us')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_recipients');
    }
}
