<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCallTimeColumnToUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_questions', function (Blueprint $table) {
            //
            $table->string('call_time')->nullable()->after('call_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_questions', function (Blueprint $table) {
            //
            $table->dropColumn(['call_time']);
        });
    }
}
