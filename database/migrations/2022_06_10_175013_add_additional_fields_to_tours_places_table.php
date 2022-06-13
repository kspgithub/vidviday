<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToToursPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_places', function (Blueprint $table) {
            $table->integer('type_id')->nullable()->default(0);

            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('direction_id')->nullable()->constrained('directions')->nullOnDelete();

            $table->json('slug')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('video')->nullable()->default(null);
            $table->integer('rating')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours_places', function (Blueprint $table) {

            $table->dropForeign('tours_places_country_id_foreign');
            $table->dropForeign('tours_places_region_id_foreign');
            $table->dropForeign('tours_places_district_id_foreign');
            $table->dropForeign('tours_places_city_id_foreign');
            $table->dropForeign('tours_places_direction_id_foreign');

            $table->dropColumn([
                'type_id',
                'country_id',
                'region_id',
                'district_id',
                'city_id',
                'direction_id',
                'slug',
                'lat',
                'lng',
                'video',
                'rating',
            ]);
        });
    }
}
