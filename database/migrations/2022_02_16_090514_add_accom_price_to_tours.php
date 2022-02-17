<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccomPriceToTours extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->decimal('accomm_price')->after('commission')->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->dropColumn('accomm_price');
        });
    }
}
