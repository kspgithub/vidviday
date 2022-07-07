<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_ads', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->text('text');
            $table->string('url');
            $table->string('image')->nullable();
            $table->integer('timeout')->nullable()->default(0);
            $table->boolean('published')->nullable()->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->json('pages')->nullable();
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
        Schema::dropIfExists('popup_ads');
    }
}
