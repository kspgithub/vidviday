<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('home_page_banners');

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('text')->nullable();
            $table->json('url')->nullable();
            $table->json('label')->nullable();
            $table->string('color')->nullable()->default('#FFB947');
            $table->boolean('show_price')->nullable();
            $table->json('price_comment')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable()->default('UAH');
            $table->string('image')->nullable();
            $table->json('image_title')->nullable();
            $table->json('image_alt')->nullable();
            $table->boolean('published')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
