<?php

use App\Models\LandingPlace;
use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToToursLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_landings', function (Blueprint $table) {
            $table->dropForeign('tours_landings_tour_id_foreign');
            $table->dropForeign('tours_landings_landing_id_foreign');
            $table->dropPrimary(['tour_id', 'landing_id']);
        });

        Schema::table('tours_landings', function (Blueprint $table) {
            $table->id()->first();
            $table->text('title')->nullable();
            $table->text('text')->nullable();
            $table->boolean('published')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours_landings', function (Blueprint $table) {
            $table->dropColumn(['id', 'title', 'text', 'published', 'created_at', 'updated_at']);
                        $table->foreign('tour_id', 'tours_landings_tour_id_foreign')
                ->references('id')->on('tours')->onDelete('cascade');

            $table->foreign('landing_id', 'tours_landings_landing_id_foreign')
                ->references('id')->on('landing_places')->onDelete('cascade');

            $table->primary(['tour_id', 'landing_id']);
        });
    }
}
