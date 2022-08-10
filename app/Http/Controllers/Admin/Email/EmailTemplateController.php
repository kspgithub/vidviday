<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\Mail\CustomEmail;
use App\Mail\OrderCertificateAdminMail;
use App\Mail\OrderCertificateMail;
use App\Mail\OrderStatusEmail;
use App\Mail\OrderTransportAdminMail;
use App\Mail\OrderTransportMail;
use App\Mail\RegistrationAdminEmail;
use App\Mail\RegistrationEmail;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Mail\UserQuestionAdminEmail;
use App\Mail\UserQuestionEmail;
use App\Mail\UserQuestionManagerEmail;
use App\Mail\VacancyEmail;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionException;

class EmailTemplateController extends Controller
{
    protected function getTemplates()
    {
        return [
            CustomEmail::class => CustomEmail::$viewKey,
            OrderCertificateAdminMail::class => OrderCertificateAdminMail::$viewKey,
            OrderCertificateMail::class => OrderCertificateMail::$viewKey,
            OrderStatusEmail::class => OrderStatusEmail::$viewKey,
            OrderTransportAdminMail::class => OrderTransportAdminMail::$viewKey,
            OrderTransportMail::class => OrderTransportMail::$viewKey,
            RegistrationAdminEmail::class => RegistrationAdminEmail::$viewKey,
            RegistrationEmail::class => RegistrationEmail::$viewKey,
            TourOrderAdminEmail::class => TourOrderAdminEmail::$viewKey,
            TourOrderEmail::class => TourOrderEmail::$viewKey,
            UserQuestionAdminEmail::class => UserQuestionAdminEmail::$viewKey,
            UserQuestionEmail::class => UserQuestionEmail::$viewKey,
            UserQuestionManagerEmail::class => UserQuestionManagerEmail::$viewKey,
            VacancyEmail::class => VacancyEmail::$viewKey,
        ];
    }

    public function index()
    {
        $dbtemplates = EmailTemplate::query()->get();

        $localTemplates = $this->getTemplates();

        $templates = [];

        foreach ($localTemplates as $mailable => $view) {
            if ($dbEntry = $dbtemplates->where('mailable', $mailable)->first()) {
                $templates[] = [
                    ...$dbEntry->toArray(),
                    'subject' => $dbEntry->subject,
                    'exists' => true,
                ];
            } else {
                $templates[] = [
                    'mailable' => $mailable,
                    'view' => $view,
                    'subject' => '',
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

        $view = $localTemplates[$mailable];

        $template = EmailTemplate::query()->where('mailable', $mailable)->firstOrNew();

        if (!$template->exists) {

            $viewContent = File::get(view($view)->getPath());

            $template->html = array_combine($locales, array_map(function ($locale) use ($viewContent) {
                return $viewContent;
            }, $locales));
        }

        return view('admin.email-template.edit', [
            'locales' => $locales,
            'mailable' => $mailable,
            'template' => $template,
        ]);
    }

    public function save(Request $request, $mailable)
    {
        $html = $request->get('html');
        $subject = $request->get('subject');

        $localTemplates = $this->getTemplates();

        $mailable = Str::replace('-', '\\', $mailable);

        $view = $localTemplates[$mailable];

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
}
