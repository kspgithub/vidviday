<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHutsulTitleToTours extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->json('hutsul_fun_title')->nullable()->after('hutsul_fun_on');
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->dropColumn('hutsul_fun_title');
        });
    }
}
