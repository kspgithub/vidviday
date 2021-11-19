<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugColumnToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $items = \App\Models\Post::all();
        foreach ($items as  $item) {
            DB::table('posts')->where('id', $item->id)->update(['slug' => json_encode(['uk' => Str::slug($item->title)])]);
        }

        Schema::table('posts', function (Blueprint $table) {
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
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->text('slug')->change();
            $table->text('title')->change();
        });
    }
}
