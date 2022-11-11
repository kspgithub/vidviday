<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->integer('rating')->default(5);
            $table->string('avatar')->nullable();
            $table->json('name')->nullable();
            $table->json('company')->nullable();
            $table->json('text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
};
