<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('newsletter_id');
            $table->unsignedInteger('custom_email_id');
            $table->tinyInteger('status')->default(0);
            $table->text('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletter_jobs');
    }
}
