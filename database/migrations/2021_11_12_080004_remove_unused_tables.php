<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(Schema::hasTable('events')) {
            Schema::dropIfExists('event_items');
            Schema::rename('events', 'event_items');
            Schema::rename('events_event_groups', 'events_groups');
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if(!Schema::hasTable('events')) {
            Schema::rename('event_items', 'events');
            Schema::rename('events_groups', 'events_event_groups');
            Schema::create('event_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
                $table->foreignId('group_id')->nullable()->constrained('event_groups')->nullOnDelete();
                $table->foreignId('direction_id')->nullable()->constrained('directions')->nullOnDelete();
                $table->text('title');
                $table->text('seo_h1')->nullable();
                $table->text('seo_title')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('seo_keywords')->nullable();
                $table->longText('text')->nullable();
                $table->string('slug');
                $table->boolean('indefinite')->default(0);
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->boolean('published')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
