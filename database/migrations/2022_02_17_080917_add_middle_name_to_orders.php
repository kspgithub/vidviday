<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMiddleNameToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('middle_name')->nullable()->after('first_name');
            $table->date('birthday')->nullable()->after('last_name');
            $table->boolean('without_place')->default(0)->after('children_young');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('without_place');
            $table->dropColumn('birthday');
            $table->dropColumn('middle_name');
        });
    }
}
