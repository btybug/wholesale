<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_rate_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('tax_rates_id');
            $table->string('locale')->index();
            $table->unique(['tax_rates_id','locale']);
            $table->timestamps();

            $table->foreign('tax_rates_id')->references('id')->on('tax_rates')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_rate_translations');
    }
}
