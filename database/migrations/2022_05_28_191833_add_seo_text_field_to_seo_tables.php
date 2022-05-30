<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoTextFieldToSeoTables extends Migration
{
    protected array $tables = [
        'directions',
        'event_groups',
        'event_items',
        'news',
        'places',
        'posts',
        'tickets',
        'tour_groups',
        'tour_subjects',
        'tour_types',
        'tours',
        'vacancies',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->text('seo_text')->nullable()->after('seo_keywords');
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
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('seo_text');
            });
        }
    }
}
