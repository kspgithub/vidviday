<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->tinyInteger('type')->default(0);
            $table->dropColumn('percentage');
        });

        Schema::rename('discounts_tours', 'tours_discounts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('tours_discounts', 'discounts_tours');

        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->decimal('percentage', 10, 2)->default(0);
        });
    }
}
