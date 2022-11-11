<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToTourAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_accommodations', function (Blueprint $table) {
            $table->dropColumn('published');

            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();

            $table->json('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_accommodations', function (Blueprint $table) {
            $table->dropForeign('tour_accommodations_country_id_foreign');
            $table->dropForeign('tour_accommodations_region_id_foreign');
            $table->dropForeign('tour_accommodations_city_id_foreign');

            $table->dropColumn([
                'country_id',
                'region_id',
                'city_id',
                'slug',
            ]);

            $table->boolean('published')->nullable()->default(0);
        });
    }
}
