<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlacesYesterdayFieldToTourSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            //
            $table->integer('places_yesterday')->nullable()->default(0)->after('places');
            $table->timestamp('places_yd_updated_at')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            //
            $table->dropColumn([
                'places_yesterday',
                'places_yd_updated_at',
            ]);
        });
    }
}
