<?php

use App\Models\TourVoting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_votings', function (Blueprint $table) {
            $table->tinyInteger('status')->nullable()->default(TourVoting::STATUS_NEW)->after('user_id');
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
            $table->dropColumn(['status']);
        });
    }
};
