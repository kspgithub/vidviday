<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitrixAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitrix_app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('access_token')->nullable();
            $table->bigInteger('expires')->nullable();
            $table->integer('expires_in')->nullable();
            $table->string('scope')->nullable();
            $table->string('domain')->nullable();
            $table->string('server_endpoint')->nullable();
            $table->string('status')->nullable();
            $table->string('client_endpoint')->nullable();
            $table->string('member_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('application_token')->nullable();
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
        Schema::dropIfExists('bitrix_app_settings');
    }
}
