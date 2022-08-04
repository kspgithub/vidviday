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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use SplFileInfo;

class EmailTemplateController extends Controller
{
    protected function getTemplates()
    {
        return [
            CustomEmail::class => view('emails.custom'),
            OrderCertificateAdminMail::class => view('emails.order-certificate-admin'),
            OrderCertificateMail::class => view('emails.order-certificate'),
            OrderStatusEmail::class => view('emails.order-status'),
            OrderTransportAdminMail::class => view('emails.order-transport-admin'),
            OrderTransportMail::class => view('emails.order-transport'),
            RegistrationAdminEmail::class => view('emails.registration-admin'),
            RegistrationEmail::class => view('emails.registration'),
            TourOrderAdminEmail::class => view('emails.order-tour'),
            TourOrderEmail::class => view('emails.order-tour'),
            UserQuestionAdminEmail::class => view('emails.user_question'),
            UserQuestionEmail::class => view('emails.user_question'),
            UserQuestionManagerEmail::class => view('emails.user_question'),
            VacancyEmail::class => view('emails.vacancy'),
        ];
    }

    public function index()
    {
        $templates = array_map(function ($view) {
            return $view->getName();
        }, $this->getTemplates());

        return view('admin.email-template.index', [
            'templates' => $templates,
        ]);
    }

    public function edit($template)
    {
        $templates = $this->getTemplates();

        $template = Str::replace('-', '\\', $template);

        $view = $templates[$template];

        $viewContent = File::get($view->getPath());

        return view('admin.email-template.edit', [
            'template' => $template,
            'viewContent' => $viewContent,
        ]);
    }

    public function save(Request $request, $template)
    {
        $content = $request->get('content');

        $templates = $this->getTemplates();

        $template = Str::replace('-', '\\', $template);

        $view = $templates[$template];

        File::put($view->getPath(), $content);

        return redirect()->route('admin.email-templates.index')->withFlashSuccess(__('Record Updated'));
    }
}
