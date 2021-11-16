<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugColumnToMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->json('title')->nullable()->change();
            $table->json('slug')->nullable()->change();
            $table->renameColumn('active', 'published');
            $table->string('side')->default('left')->after('position');
            $table->string('class_name')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->text('title')->nullable()->change();
            $table->text('slug')->nullable()->change();
            $table->renameColumn('published', 'active');
            $table->dropColumn('side');
            $table->dropColumn('class_name');
        });
    }
}
