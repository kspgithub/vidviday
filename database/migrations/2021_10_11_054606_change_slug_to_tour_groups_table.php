<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugToTourGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_groups', function (Blueprint $table) {
            //
            DB::table('tour_groups')->update(['slug'=>'{}']);
            $table->json('slug')->nullable()->change();
            \App\Models\TourGroup::all()->each(function ($group) {
                $group->slug = \Illuminate\Support\Str::slug($group->title);
                $group->save();
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
        Schema::table('tour_groups', function (Blueprint $table) {
            //
            $table->text('slug')->nullable()->change();
        });
    }
}
