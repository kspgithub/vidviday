<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_certificates', function (Blueprint $table) {
            $table->integer('payment_online')->after('payment_status')->default(0);
        });
    }

    public function down()
    {
        Schema::table('order_certificates', function (Blueprint $table) {
            $table->dropColumn('payment_online');
        });
    }
};
