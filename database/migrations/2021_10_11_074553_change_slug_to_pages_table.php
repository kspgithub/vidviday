<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            DB::table('pages')->update(['slug'=>'{}']);

            $table->json('slug')->nullable()->change();
            \App\Models\Page::all()->each(function ($page) {
                $page->slug = \Illuminate\Support\Str::slug($page->title);
                $page->save();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //

            $table->text('slug')->nullable()->change();
        });
    }
}
