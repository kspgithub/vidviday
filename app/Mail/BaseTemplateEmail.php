<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;

class BaseTemplateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public static $viewKey;

    public static $subjectKey;

    public $showFooter = true;

    public function build()
    {
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'));

        /** @var $template EmailTemplate */
        $template = EmailTemplate::query()->where('mailable', static::class)->first();

        $locale = app()->getLocale();

        if($template) {
            $subject = $template->getTranslation('subject', $locale);
            $html = $template->getTranslation('html', $locale);

            foreach ($this->getReplaces() as $key => $value) {
                $replaceFrom = '{{ ' . $key . ' }}';
                $replaceTo = is_callable($value) ? $value() : $value;
                $subject = str_replace($replaceFrom, $replaceTo, $subject);
                $html = str_replace($replaceFrom, $replaceTo, $html);
            }
            $mail->subject($subject);
            $mail->html(Blade::render($html, $this->buildViewData()));
        } else {
            $mail->subject(__(static::$subjectKey))
                ->view(static::$viewKey);
        }

        return $mail;
    }

    public function getReplaces()
    {
        return [];
    }
}
