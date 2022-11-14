<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocalesColumnToToursTable extends Migration
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
            $table->json('locales')->nullable()->after('slug');
        });

        \Illuminate\Support\Facades\DB::table('tours')->update(['locales' => json_encode(['uk'])]);
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
            $table->dropColumn('locales');
        });
    }
}
