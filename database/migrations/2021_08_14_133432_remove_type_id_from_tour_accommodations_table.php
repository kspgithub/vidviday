<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTypeIdFromTourAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('tour_accommodations', 'type_id')) {
            Schema::table('tour_accommodations', function (Blueprint $table) {
                //
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $table->dropColumn('type_id');
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
