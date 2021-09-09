<?php

use Database\Traits\CheckForeignTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTypeIdFromTourAccommodationsTable extends Migration
{
    use CheckForeignTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('tour_accommodations', 'type_id')) {
            Schema::table('tour_accommodations', function (Blueprint $table) {
                //
                if ($this->foreignExist('tour_accommodations', 'tour_accommodations_type_id_foreign')) {
                    $table->dropForeign('tour_accommodations_type_id_foreign');
                }
                $table->dropColumn('type_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
