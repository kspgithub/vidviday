<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeIdToFood extends Migration
{
    public function up()
    {
        Schema::table('food', function (Blueprint $table) {
            //
            $table->foreignId('time_id')->nullable()->after('id')->constrained('food_times')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->after('time_id')->constrained('regions')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('food', function (Blueprint $table) {
            //
            $table->dropForeign('food_time_id_foreign');
            $table->dropForeign('food_region_id_foreign');
            $table->dropColumn('time_id');
            $table->dropColumn('region_id');
        });
    }
}
