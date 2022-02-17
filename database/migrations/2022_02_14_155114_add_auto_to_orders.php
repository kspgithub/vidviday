<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->boolean('auto')->after('status')->default(0);
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('auto');
        });
    }
}
