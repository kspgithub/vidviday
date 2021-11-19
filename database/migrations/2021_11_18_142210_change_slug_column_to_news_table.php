<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugColumnToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $items = \App\Models\News::all();
        foreach ($items as  $item) {
            DB::table('news')->where('id', $item->id)->update(['slug'=> json_encode(['uk'=> Str::slug($item->title)])]);
        }

        Schema::table('news', function (Blueprint $table) {
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
        Schema::table('news', function (Blueprint $table) {
            //
            $table->text('slug')->change();
            $table->text('title')->change();
        });
    }
}
