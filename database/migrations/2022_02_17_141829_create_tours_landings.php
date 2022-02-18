<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursLandings extends Migration
{
    public function up()
    {
        Schema::create('tours_landings', function (Blueprint $table) {
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete();
            $table->foreignId('landing_id')->constrained('landing_places')->cascadeOnDelete();
            $table->integer('position')->default(0);
            $table->primary(['tour_id', 'landing_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tours_landings');
    }
}
