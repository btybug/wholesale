<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',100);
            $table->string('last_name',100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone',100)->unique();
            $table->text('avatar')->nullable();
            $table->text('referred_by')->nullable();
            $table->text('referral_code')->nullable();
            $table->string('country',100);
            $table->enum('gender',['male','female']);
            $table->date('dob');
            $table->tinyInteger('status')->default(0);
            $table->integer('age')->default(0);
            $table->integer('role_id')->nullable()->unsigned();
            $table->string('verification_type',20)->nullable();
            $table->string('verification_image')->nullable();
            $table->string('customer_number')->unique();
            $table->string('company_name')->nullable();
            $table->string('company_number')->nullable();
            $table->tinyInteger('wholesaler_status')->default(0);

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')->on('roles')
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
    }
}
