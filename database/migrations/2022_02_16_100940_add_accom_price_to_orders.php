<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccomPriceToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->decimal('accomm_price')->after('commission')->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('accomm_price');
        });
    }
}
