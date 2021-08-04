<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddRatingColumnToToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->integer('rating')->default(0)->after('currency');
            $table->integer('nights')->nullable()->after('duration');

            $table->dropColumn('new');
            $table->dropColumn('bestseller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->dropColumn('rating');
            $table->dropColumn('nights');

            $table->boolean('new')->default(0)->after('currency');
            $table->boolean('bestseller')->default(0)->after('new');
        });
    }
}
