<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
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
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $foreignKeys = array_map(function(ForeignKeyConstraint $foreignKey) {
            return $foreignKey->getName();
        }, $conn->listTableForeignKeys('tours_places'));

        Schema::table('tours_places', function (Blueprint $table) use ($foreignKeys) {
            if(in_array('tour_places_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_places_tour_id_foreign');
            }
            if(in_array('tour_places_place_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_places_place_id_foreign');
            }
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
