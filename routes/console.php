<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());

    $tables = Schema::getAllTables();

    $seo_tables = [];

    foreach ($tables as $table) {
        $tableName = $table->Tables_in_vidviday_prod;

        $columns = Schema::getColumnListing($tableName);

        if(in_array('seo_h1', $columns) && !in_array('seo_text', $columns)) {
            $seo_tables[] = $tableName;
        }
    }
    dd($seo_tables);

})->purpose('Display an inspiring quote');
