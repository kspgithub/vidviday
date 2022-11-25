<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelMorphToPopularTours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('popular_tours', function (Blueprint $table) {
            $table->after('tour_id', fn() => $table->nullableMorphs('model'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('popular_tours', function (Blueprint $table) {
            $table->dropMorphs('model');
        });
    }
}
