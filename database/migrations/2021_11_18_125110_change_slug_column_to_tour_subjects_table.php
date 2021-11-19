<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ChangeSlugColumnToTourSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $items = \App\Models\TourSubject::all();
        foreach ($items as  $item) {
            DB::table('tour_subjects')->where('id', $item->id)->update(['slug'=> json_encode(['uk'=> Str::slug($item->title)])]);
        }

        Schema::table('tour_subjects', function (Blueprint $table) {
            //
            $table->json('slug')->change();
            $table->json('title')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_subjects', function (Blueprint $table) {
            //
            $table->text('slug')->change();
            $table->text('title')->change();
        });
    }
}
