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

    $test[] = Lang::choice('st|nd|rd|th', 1, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 2, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 3, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 4, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 5, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 6, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 7, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 8, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 9, [], 'en');
    $test[] = Lang::choice('st|nd|rd|th', 22, [], 'en');

    dd($test);
})->purpose('Display an inspiring quote');
