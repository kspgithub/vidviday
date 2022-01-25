<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTitleWhereInAccommodations extends Migration
{
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            //
            $table->dropColumn('title_where');
        });
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            //
            $table->json('title_where')->after('title')->nullable();
        });
    }
}
