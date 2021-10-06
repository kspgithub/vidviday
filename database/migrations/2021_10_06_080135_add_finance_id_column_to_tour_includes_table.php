<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinanceIdColumnToTourIncludesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_includes', function (Blueprint $table) {
            //
            $table->foreignId('finance_id')->after('tour_id')->nullable()->constrained('finances')->cascadeOnDelete();
            $table->renameColumn('title', 'text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_includes', function (Blueprint $table) {
            //
            $table->dropForeign('tour_includes_finance_id_foreign');
            $table->dropColumn('finance_id');
            $table->renameColumn('text', 'title');
        });
    }
}
