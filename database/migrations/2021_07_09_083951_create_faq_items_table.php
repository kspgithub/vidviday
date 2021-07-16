<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_items', function (Blueprint $table) {
            $table->id();
            $table->string('section')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(1);
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
        Schema::dropIfExists('faq_items');
    }
}
