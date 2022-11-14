<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAccommodationIdNullableInTourAccommodationsTable extends Migration
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
        }, $conn->listTableForeignKeys('tour_accommodations'));

        Schema::table('tour_accommodations', function (Blueprint $table) use ($foreignKeys) {
            if (in_array('tour_accommodations_accommodation_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_accommodations_accommodation_id_foreign');
            }
        });

        Schema::table('tour_accommodations', function (Blueprint $table) {
            $table->unsignedBigInteger('accommodation_id')->nullable()->change();
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
        });
    }
}
