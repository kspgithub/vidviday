<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPlacesTable extends Migration
{
    public function up()
    {
        Schema::create('landing_places', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('slug');
            $table->boolean('published')->default(0);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('landing_places');
    }
}
