<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletePlacesBookedFromTourSchedules extends Migration
{
    public function up()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            //
            $table->dropColumn('places_booked');
        });
    }

    public function down()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            $table->integer('places_booked')->default(0);
        });
    }
}
