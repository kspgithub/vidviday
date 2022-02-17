<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDutyFieldsToTourSchedules extends Migration
{
    public function up()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            //
            $table->text('duty_comment')->after('duty_call')->nullable();
            $table->boolean('auto_booking')->default(0)->after('places');
            $table->integer('auto_limit')->default(10)->after('auto_booking');
        });
    }

    public function down()
    {
        Schema::table('tour_schedules', function (Blueprint $table) {
            //
            $table->dropColumn('duty_comment');
            $table->dropColumn('auto_booking');
            $table->dropColumn('auto_limit');
        });
    }
}
