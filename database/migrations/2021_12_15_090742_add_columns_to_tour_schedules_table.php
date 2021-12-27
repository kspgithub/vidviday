<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTourSchedulesTable extends Migration
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
            $table->string('bus')->nullable()->after('comment');
            $table->string('guide')->nullable()->after('bus');
            $table->string('duty_transport')->nullable()->after('guide');
            $table->string('duty_call')->nullable()->after('duty_transport');
            $table->text('admin_comment')->nullable()->after('duty_call');
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
                'bus',
                'guide',
                'duty_transport',
                'duty_call',
                'admin_comment',
            ]);
        });
    }
}
