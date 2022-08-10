<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Blade;

class BaseTemplateEmail extends Mailable
{
    public function build()
    {
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'));

        /** @var $template EmailTemplate */
        $template = EmailTemplate::query()->where('mailable', self::class)->first();

        $locale = app()->getLocale();

        if($template) {
            $subject = $template->getTranslation('subject', $locale);
            $html = $template->getTranslation('html', $locale);
            $mail->subject($subject);
            $mail->html(Blade::render($html, $this->buildViewData()));
        } else {
            $mail->subject(__(self::$subjectKey))
                ->view(self::$viewKey);
        }

        return $mail;
    }
}
