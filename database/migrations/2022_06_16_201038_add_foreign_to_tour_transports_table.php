<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToTourTransportsTable extends Migration
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
        }, $conn->listTableForeignKeys('tour_transports'));

        Schema::table('tour_transports', function (Blueprint $table) use ($foreignKeys) {
            if (! in_array('tour_transports_tour_id_foreign', $foreignKeys)) {
                $table->foreign('tour_id')->references('id')->on('tours')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            }
            if (! in_array('tour_transports_transport_id_foreign', $foreignKeys)) {
                $table->foreign('transport_id')->references('id')->on('transports')
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
        }, $conn->listTableForeignKeys('tour_transports'));

        Schema::table('tour_transports', function (Blueprint $table) use ($foreignKeys) {
            if (in_array('tour_transports_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_transports_tour_id_foreign');
            }
            if (in_array('tour_transports_transport_id_foreign', $foreignKeys)) {
                $table->dropForeign('tour_transports_transport_id_foreign');
            }
        });
    }
}
