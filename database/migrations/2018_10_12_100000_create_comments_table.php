<?php
/** actuallymab | 12.06.2016 - 02:00 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->string('section');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('author_id')->nullable()->unsigned();
            $table->longText('comment');
            $table->tinyInteger('status')->default(0);
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('comments')
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
        Schema::dropIfExists('comments');
    }
}
