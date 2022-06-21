<?php

use App\Models\Ticket;
use App\Models\TourTicket;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignToToursTicketsTable extends Migration
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
        }, $conn->listTableForeignKeys('tours_tickets'));

        Schema::table('tours_tickets', function (Blueprint $table) use ($foreignKeys) {
            if(!in_array('tours_tickets_tour_id_foreign', $foreignKeys)) {
                $table->foreign('tour_id')->references('id')->on('tours')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            }
            if(!in_array('tours_tickets_ticket_id_foreign', $foreignKeys)) {
                $table->foreign('ticket_id')->references('id')->on('tickets')
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
        }, $conn->listTableForeignKeys('tours_tickets'));

        Schema::table('tours_tickets', function (Blueprint $table) use ($foreignKeys) {
            if(in_array('tours_tickets_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('tours_tickets_tour_id_foreign');
            }
            if(in_array('tours_tickets_ticket_id_foreign', $foreignKeys)) {
                $table->dropForeign('tours_tickets_ticket_id_foreign');
            }
        });
    }
}
