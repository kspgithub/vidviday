<?php

use App\Models\LanguageLine;
use App\Models\Tour;
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

    $data= [];

    $langLinesAsc = LanguageLine::where('key', 'sorting.created-asc')->first();
    $langLinesDesc = LanguageLine::where('key', 'sorting.created-desc')->first();
    $langLinesAsc->update(['key' => 'sorting.created-desc']);
    $langLinesDesc->update(['key' => 'sorting.created-asc']);

    dd($data);

})->purpose('Display an inspiring quote');
