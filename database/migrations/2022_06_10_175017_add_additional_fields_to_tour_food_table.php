<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToTourFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_food', function (Blueprint $table) {
            $table->dropColumn('published');

            $table->integer('type_id')->nullable()->default(0);
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();

            $table->decimal('price')->nullable()->default(0);
            $table->string('currency')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_food', function (Blueprint $table) {

            $table->dropForeign('tour_food_country_id_foreign');
            $table->dropForeign('tour_food_region_id_foreign');

            $table->dropColumn([
                'type_id',
                'country_id',
                'region_id',
                'price',
                'currency',
            ]);
            $table->boolean('published')->nullable()->default(0);
        });
    }
}

