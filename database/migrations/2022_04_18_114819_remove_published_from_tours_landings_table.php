<?php

use App\Models\LandingPlace;
use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePublishedFromToursLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_landings', function (Blueprint $table) {
            $table->dropColumn('published');
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
            $table->boolean('published')->nullable()->default(0);
        });
    }
}
