<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookedColumnToTourSchedulesTable extends Migration
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
            $table->integer('bitrix_id')->after('id')->nullable();
            $table->integer('places_booked')->after('places')->default(0);
            $table->text('comment')->after('currency')->nullable();
            $table->tinyInteger('status')->after('tour_id')->default(0);
            $table->softDeletes();
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
            $table->dropColumn('bitrix_id');
            $table->dropColumn('places_booked');
            $table->dropColumn('comment');
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
}
