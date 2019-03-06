<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterLinksTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_links_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('footer_links_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('locale')->index();
            $table->unique(['footer_links_id','locale']);
            $table->timestamps();

            $table->foreign('footer_links_id')->references('id')->on('footer_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer__links_translations');
    }
}
