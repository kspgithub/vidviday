<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWithoutPlaceCountToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->integer('without_place_count')->default(0)->after('without_place');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('without_place_count');
        });
    }
}
