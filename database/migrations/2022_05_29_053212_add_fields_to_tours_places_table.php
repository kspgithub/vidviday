<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToToursPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_places', function (Blueprint $table) {
            $table->dropForeign('tour_places_tour_id_foreign');
            $table->dropForeign('tour_places_place_id_foreign');
            $table->dropPrimary(['tour_id', 'place_id']);
        });

        Schema::table('tours_places', function (Blueprint $table) {
            $table->id()->first();
            $table->unsignedBigInteger('place_id')->nullable()->change();
            $table->text('title')->nullable();
            $table->text('text')->nullable();

            $table->foreign('tour_id', 'tour_places_tour_id_foreign')
                ->references('id')->on('tours')->onDelete('cascade');
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
            $table->unsignedBigInteger('place_id')->change();
            $table->dropColumn(['id', 'title', 'text']);
            $table->primary(['tour_id', 'place_id']);
        });
    }
}
