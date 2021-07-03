<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('seo_h1')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->longText('text')->nullable();
            $table->longText('short_text')->nullable();
            $table->string('slug');

            $table->integer('duration')->default(1);
            $table->boolean('published')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency')->nullable()->default('UAH');

            $table->boolean('new')->default(0);
            $table->boolean('bestseller')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('tours');
    }
}
