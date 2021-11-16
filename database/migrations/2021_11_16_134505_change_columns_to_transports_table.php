<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports', function (Blueprint $table) {
            //
            $table->string('image')->nullable()->after('text');
            $table->json('title')->nullable()->change();
            $table->json('text')->nullable()->change();

            $table->dropColumn('seo_h1');
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports', function (Blueprint $table) {
            //
            $table->dropColumn('image');
            $table->text('title')->nullable()->change();
            $table->text('text')->nullable()->change();
            $table->text('seo_h1')->nullable()->after('title');
            $table->text('seo_title')->nullable()->after('seo_h1');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->text('seo_keywords')->nullable()->after('seo_description');
        });
    }
}
