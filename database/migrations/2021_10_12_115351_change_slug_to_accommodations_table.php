<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugToAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            //
            //
            DB::table('accommodations')->update(['slug'=>'{}']);
            $table->json('slug')->nullable()->change();
            \App\Models\Accommodation::all()->each(function ($model) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
                $model->save();
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
        Schema::table('accommodations', function (Blueprint $table) {
            //
            $table->text('slug')->nullable()->change();
        });
    }
}
