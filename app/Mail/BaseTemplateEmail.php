<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class BaseTemplateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public static $viewKey;

    public static $subjectKey;

    public $showFooter = true;

    public $attachment = null;

    public Contact $contact;

    public string $showOnMapUrl;

    public function build()
    {
        $this->contact = Contact::first();

        $this->showOnMapUrl = config('contacts.show-on-map-url');

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
            $html = Blade::render($html, $this->buildViewData());
        } else {
            $mail->subject(trans(static::$subjectKey));
            $mail->view(static::$viewKey);
            $html = $mail->render();
        }

//        $cssToInlineStyles = new CssToInlineStyles();

//        $html = $cssToInlineStyles->convert($html);

        $mail->html($html);

        if($this->attachment) {
            $mail->attach($this->attachment);
        }

        return $mail;
    }

    public function getReplaces(): array
    {
        return [];
    }
}
