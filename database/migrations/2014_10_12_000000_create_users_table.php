<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('password');
            $table->string('email')->unique();

            $table->tinyInteger('status')->default(1);

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();

            $table->string('avatar')->nullable();

            $table->date('birthday')->nullable();

            $table->string('mobile_phone')->nullable();
            $table->string('viber')->nullable();

            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('work_email')->nullable();
            $table->string('website')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('timezone')->nullable();

            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
