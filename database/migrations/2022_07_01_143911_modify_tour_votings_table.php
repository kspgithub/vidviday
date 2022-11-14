<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_votings', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);

            $table->string('name')->after('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_votings', function (Blueprint $table) {
            $table->dropColumn(['name']);

            $table->string('last_name')->after('ip');
            $table->string('first_name')->after('ip');
        });
    }
};
