<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class   AddAdditionalFieldsToTourTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_transports', function (Blueprint $table) {
            $table->unsignedBigInteger('transport_id')->nullable()->change();
            $table->integer('type_id')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_transports', function (Blueprint $table) {
            $table->dropColumn(['type_id']);
        });
    }
}
