<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToToursPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $foreignKeys = array_map(function (ForeignKeyConstraint $foreignKey) {
            return $foreignKey->getName();
        }, $conn->listTableForeignKeys('tours_places'));

        Schema::table('tours_places', function (Blueprint $table) use ($foreignKeys) {
            if (! in_array('tours_places_tour_id_foreign', $foreignKeys)) {
                $table->foreign('tour_id')->references('id')->on('tours')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            }
            if (! in_array('tours_places_place_id_foreign', $foreignKeys)) {
                $table->foreign('place_id')->references('id')->on('places')
                    ->onDelete('SET NULL')
                    ->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $foreignKeys = array_map(function (ForeignKeyConstraint $foreignKey) {
            return $foreignKey->getName();
        }, $conn->listTableForeignKeys('tours_places'));

        Schema::table('tours_places', function (Blueprint $table) use ($foreignKeys) {
            if (in_array('tours_places_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('tours_places_tour_id_foreign');
            }
            if (in_array('tours_places_place_id_foreign', $foreignKeys)) {
                $table->dropForeign('tours_places_place_id_foreign');
            }
        });
    }
}
