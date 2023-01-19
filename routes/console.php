<?php

use App\Mail\CustomEmail;
use App\Mail\UserQuestionEmail;
use App\Models\LanguageLine;
use App\Models\QuestionType;
use App\Models\Tour;
use App\Models\UserQuestion;
use App\Notifications\TestNotification;
use App\Services\MailNotificationService;
use Daaner\TurboSMS\Facades\TurboSMS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
    $quote = Inspiring::quote();
    $this->comment($quote);
    TurboSMS::sendMessages('+380632876727', $quote);
})->purpose('Display an inspiring quote');
