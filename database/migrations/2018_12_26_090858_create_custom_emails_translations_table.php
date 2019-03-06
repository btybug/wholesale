<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomEmailsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_emails_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('custom_emails_id')->unsigned();
            $table->string('subject');
            $table->longText('content');
            $table->string('locale')->index();
            $table->unique(['custom_emails_id','locale']);
            $table->foreign('custom_emails_id')->references('id')->on('custom_emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_email_translations');
    }
}
