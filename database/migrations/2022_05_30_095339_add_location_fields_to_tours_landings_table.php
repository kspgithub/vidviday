<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationFieldsToToursLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_landings', function (Blueprint $table) {
            $table->json('description')->nullable();
            $table->json('slug')->nullable();
            $table->boolean('published')->default(0);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->integer('type')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours_landings', function (Blueprint $table) {
            $table->dropColumn(['description', 'slug', 'published', 'lat', 'lng', 'type']);
        });
    }
}
