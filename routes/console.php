<?php

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

    $data = [];

    $regex = '/q=(\d+)/';
    $uri = '/tours?q=12';

    $result = preg_match($regex, $uri, $matches);

    $data['matches'] = $matches;
    $data['result'] = $result;

    dd($data);

})->purpose('Display an inspiring quote');
