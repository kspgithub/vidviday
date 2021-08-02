<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDayColumnToTourFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_food', function (Blueprint $table) {
            //
            $table->integer('day')->default(1)->after('tour_id');

            $table->text('title')->nullable()->change();
            $table->string('slug')->nullable()->change();
            $table->integer('position')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_food', function (Blueprint $table) {
            //
            $table->dropColumn('day');

        });
    }
}
