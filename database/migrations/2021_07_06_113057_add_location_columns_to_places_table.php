<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationColumnsToPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            //
            $table->foreignId('country_id')->after('id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('region_id')->after('country_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('city_id')->after('region_id')->nullable()->constrained('cities')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            //
            $table->dropForeign('places_country_id_foreign');
            $table->dropForeign('places_region_id_foreign');
            $table->dropForeign('places_city_id_foreign');
            $table->dropColumn('country_id');
            $table->dropColumn('region_id');
            $table->dropColumn('city_id');
        });
    }
}
