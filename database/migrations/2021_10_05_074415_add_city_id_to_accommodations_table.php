<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            //
            $table->text('title_where')->nullable()->after('title');
            $table->foreignId('city_id')->after('region_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->dropColumn('populated_area');
            $table->dropColumn('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            //
            $table->string('place')->after('region_id')->nullable();
            $table->string('populated_area')->after('region_id')->nullable();

            $table->dropForeign('accommodations_city_id_foreign');
            $table->dropColumn(['city_id', 'title_where']);
        });
    }
}
