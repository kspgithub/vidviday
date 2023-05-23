<?php

use App\Mail\CustomEmail;
use App\Mail\OrderTransportMail;
use App\Mail\TourOrderEmail;
use App\Mail\UserQuestionEmail;
use App\Models\EmailTemplate;
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
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

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

    $mailable = TourOrderEmail::class;

    $mailableClass = new $mailable;

    /** @var EmailTemplate $template */
    $template = EmailTemplate::query()->where('mailable', $mailable)->first();

    $locale = app()->getLocale();

    $cssToInlineStyles = new CssToInlineStyles();

    if($template) {
        $subject = $template->getTranslation('subject', $locale);
        $html = $template->getTranslation('html', $locale);

        foreach ($mailableClass->getReplaces() as $key => $value) {
            $replaceFrom = '{{ ' . $key . ' }}';
            $replaceTo = is_callable($value) ? $value() : $value;
            $subject = str_replace($replaceFrom, $replaceTo, $subject);
            $html = str_replace($replaceFrom, $replaceTo, $html);
        }

        $html = $cssToInlineStyles->convert($html);

        $html = htmlspecialchars_decode($html);
        dd(Blade::render($html, $mailableClass->buildViewData()));
        dd($html);
    }

})->purpose('Display an inspiring quote');
