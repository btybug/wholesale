<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_promotion')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('section_type')->default(0);
            $table->string('image')->nullable();
            $table->text('other_images')->nullable();
            $table->string('what_is_image')->nullable();
            $table->text('videos')->nullable();
            $table->tinyInteger('faq_tab')->nullable();
            $table->tinyInteger('reviews_tab')->nullable();
            $table->tinyInteger('is_offer')->default(0);
            $table->tinyInteger('offer_type')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('CASCADE');

            $table->foreign('brand_id')->references('id')
                ->on('brands')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
