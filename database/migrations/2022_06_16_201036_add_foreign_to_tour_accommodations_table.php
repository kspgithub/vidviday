<?php

use App\Models\Discount;
use App\Models\TourDiscount;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignToTourAccommodationsTable extends Migration
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
        }, $conn->listTableForeignKeys('tour_accommodations'));

        Schema::table('tour_accommodations', function (Blueprint $table) use ($foreignKeys) {
            if(!in_array('tour_accommodations_tour_id_foreign', $foreignKeys)) {
                $table->foreign('tour_id')->references('id')->on('tours')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            }
            if(!in_array('tour_accommodations_accommodation_id_foreign', $foreignKeys)) {
                $table->foreign('accommodation_id')->references('id')->on('accommodations')
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

        $foreignKeys = array_map(function(ForeignKeyConstraint $foreignKey) {
            return $foreignKey->getName();
        }, $conn->listTableForeignKeys('tour_accommodations'));

        Schema::table('tour_accommodations', function (Blueprint $table) use ($foreignKeys) {
            if(in_array('tour_accommodations_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_accommodations_tour_id_foreign');
            }
            if(in_array('tour_accommodations_accommodation_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_accommodations_accommodation_id_foreign');
            }
        });
    }
}
