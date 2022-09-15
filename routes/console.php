<?php

use App\Mail\CustomEmail;
use App\Mail\UserQuestionEmail;
use App\Models\LanguageLine;
use App\Models\QuestionType;
use App\Models\Tour;
use App\Models\UserQuestion;
use App\Services\MailNotificationService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

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
    Mail::to('maksym.shekhovtsev@gmail.com')->queue(new CustomEmail('test', 'subject test'));
})->purpose('Display an inspiring quote');
