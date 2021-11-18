<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentColumnToUserQuestionsTable extends Migration
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
            $table->string('attachment')->nullable()->after('call_time');
            $table->string('attachment_name')->nullable()->after('attachment');
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
            $table->dropColumn('attachment');
            $table->dropColumn('attachment_name');
        });
    }
}
