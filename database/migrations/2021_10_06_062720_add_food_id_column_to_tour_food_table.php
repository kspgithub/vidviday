<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFoodIdColumnToTourFoodTable extends Migration
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
            $table->foreignId('food_id')->after('tour_id')->nullable()->constrained('food')->cascadeOnDelete();
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
            $table->dropForeign('tour_food_food_id_foreign');
            $table->dropColumn('food_id');
        });
    }
}
