<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\Mail\BaseTemplateEmail;
use App\Mail\OrderBrokerAdminMail;
use App\Mail\OrderBrokerMail;
use App\Mail\OrderCertificateAdminMail;
use App\Mail\OrderCertificateMail;
use App\Mail\OrderNoteEmail;
use App\Mail\OrderStatusEmail;
use App\Mail\OrderTransportAdminMail;
use App\Mail\OrderTransportMail;
use App\Mail\RegistrationAdminEmail;
use App\Mail\RegistrationEmail;
use App\Mail\TestimonialAdminEmail;
use App\Mail\TestimonialAnswerEmail;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Mail\UserQuestionAdminEmail;
use App\Mail\UserQuestionEmail;
use App\Mail\UserQuestionManagerEmail;
use App\Mail\VacancyEmail;
use App\Models\Contact;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionException;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class EmailTemplateController extends Controller
{
    public function getTemplates()
    {
        return [
            OrderCertificateAdminMail::class,
            OrderCertificateMail::class,
            OrderStatusEmail::class,
            OrderNoteEmail::class,
            OrderTransportAdminMail::class,
            OrderTransportMail::class,
            OrderBrokerAdminMail::class,
            OrderBrokerMail::class,
            RegistrationAdminEmail::class,
            RegistrationEmail::class,
            TourOrderAdminEmail::class,
            TourOrderEmail::class,
            UserQuestionAdminEmail::class,
            UserQuestionEmail::class,
            UserQuestionManagerEmail::class,
            VacancyEmail::class,
            TestimonialAdminEmail::class,
            TestimonialAnswerEmail::class,
        ];
    }

    public function index()
    {
        $dbtemplates = EmailTemplate::query()->get();

        $localTemplates = $this->getTemplates();

        $templates = [];

        foreach ($localTemplates as $mailable) {
            $mailableClass = new $mailable;

            if ($dbEntry = $dbtemplates->where('mailable', $mailable)->first()) {
                $templates[] = [
                    ...$dbEntry->toArray(),
                    'subject' => $dbEntry->subject,
                    'exists' => true,
                ];
            } else {
                $templates[] = [
                    'mailable' => $mailable,
                    'view' => $mailableClass::$viewKey,
                    'subject' => $mailableClass::$subjectKey,
                    'exists' => false,
                    'updated_at' => null,
                ];
            }
        }

        return view('admin.email-template.index', [
            'templates' => $templates,
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function edit($mailable)
    {
        $locales = siteLocales();

        $localTemplates = $this->getTemplates();

        $mailable = Str::replace('-', '\\', $mailable);

        if(!in_array($mailable, $localTemplates)) {
            throw new \Exception('Mailable ' . $mailable .' not found.');
        }

        /** @var $mailableClass BaseTemplateEmail */
        $mailableClass = new $mailable;

        $mailableView = $mailableClass::$viewKey;

        $mailableSubject = $mailableClass::$subjectKey;

        $replaces = array_keys($mailableClass->getReplaces());

        $template = EmailTemplate::query()->where('mailable', $mailable)->firstOrNew();

        if (!$template->exists) {

            $viewContent = File::get(view($mailableView)->getPath());

            $template->html = array_combine($locales, array_map(function ($locale) use ($viewContent) {
                return $viewContent;
            }, $locales));

            $subject = [];

            foreach (siteLocales() as $locale) {
                $subject[$locale] = __($mailableSubject, [], $locale);
            }

            $template->subject = $subject;
        }

        return view('admin.email-template.edit', [
            'locales' => $locales,
            'mailable' => $mailable,
            'template' => $template,
            'replaces' => $replaces,
        ]);
    }

    public function save(Request $request, $mailable)
    {
        $html = $request->get('html');
        $subject = $request->get('subject');

        $localTemplates = $this->getTemplates();

        $mailable = Str::replace('-', '\\', $mailable);

        if(!in_array($mailable, $localTemplates)) {
            throw new \Exception('Mailable ' . $mailable .' not found.');
        }

        $mailableClass = new $mailable;

        $view = $mailableClass::$viewKey;

        $emailTemplate = EmailTemplate::query()->where('mailable', $mailable)->firstOrNew([
            'mailable' => $mailable,
        ], [
            'mailable' => $mailable,
            'view' => $view,
        ]);

        $emailTemplate->html = $html;
        $emailTemplate->subject = $subject;
        $emailTemplate->save();

//        File::put(view($view)->getPath(), $content);

        return redirect()->route('admin.email-templates.index')->withFlashSuccess(__('Record Updated'));
    }

    public function reset($mailable)
    {
        $localTemplates = $this->getTemplates();

        $mailable = Str::replace('-', '\\', $mailable);

        if(!in_array($mailable, $localTemplates)) {
            throw new \Exception('Mailable ' . $mailable .' not found.');
        }

        $emailTemplate = EmailTemplate::query()->where('mailable', $mailable)->first();

        if($emailTemplate) {
            $emailTemplate->delete();
        }

        return redirect()->back();
    }

    public function preview($mailable)
    {
        $localTemplates = $this->getTemplates();

        $mailable = Str::replace('-', '\\', $mailable);

        /** @var BaseTemplateEmail $mailableClass */
        $mailableClass = new $mailable;

        if(!in_array($mailable, $localTemplates)) {
            throw new \Exception('Mailable ' . $mailable .' not found.');
        }

        $mailableClass->contact = Contact::first();

        $mailableClass->showOnMapUrl = config('contacts.show-on-map-url');

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

            return Blade::render($html, $mailableClass->buildViewData());
        } else {
            $html = $mailableClass->render();

            $html = $cssToInlineStyles->convert($html);

            return $html;
        }
    }
}
