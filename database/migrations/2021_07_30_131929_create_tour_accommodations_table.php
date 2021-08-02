<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('accommodation_types')->cascadeOnDelete();
            $table->text('title')->nullable();
            $table->text('text')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('published')->default(0);
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
        Schema::dropIfExists('tour_accommodations');
    }
}
