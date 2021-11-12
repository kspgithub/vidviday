<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugColumnToEventGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_groups', function (Blueprint $table) {
            //
            $table->json('title')->nullable()->change();
            $table->json('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_groups', function (Blueprint $table) {
            //
            $table->text('title')->nullable()->change();
            $table->text('slug')->nullable()->change();
        });
    }
}
