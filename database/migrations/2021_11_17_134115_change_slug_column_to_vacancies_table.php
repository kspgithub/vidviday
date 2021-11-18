<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSlugColumnToVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $vacancies = \App\Models\Vacancy::all();
        foreach ($vacancies as  $vacancy) {
            $vacancy->slug = \Illuminate\Support\Str::slug($vacancy->title);
            $vacancy->save();
        }

        Schema::table('vacancies', function (Blueprint $table) {
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
        Schema::table('vacancies', function (Blueprint $table) {
            //
            $table->text('slug')->change();
            $table->text('title')->change();
        });
    }
}
