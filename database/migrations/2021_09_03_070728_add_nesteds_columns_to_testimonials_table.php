<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNestedsColumnsToTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            //
            $table->unsignedInteger('parent_id')->nullable()->default(null)->change();
            $table->unsignedInteger('_rgt')->after('parent_id');
            $table->unsignedInteger('_lft')->after('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            //
            $table->dropColumn('_lft');
            $table->dropColumn('_rgt');
            $table->unsignedBigInteger('parent_id')->default(0)->change();
        });
    }
}
