<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailNotifyRequest;
use App\Services\MailNotificationService;
use Illuminate\Http\JsonResponse;

class CrmNotificationsController extends Controller
{
    /**
     * Отправка сообщений
     *
     * @param MailNotifyRequest  $request
     *
     * @return JsonResponse
     */
    public function notifyEmail(MailNotifyRequest $request)
    {
        //
        $email = $request->email;
        $subject = $request->subject ?? 'Нове повідомлення';
        $message = $request->message;
        if (MailNotificationService::customMail($email, $message, $subject)) {
            return response()->json(['result' => 'success', 'message' => __('Mail Sent')]);
        }

        return response()->json(['result' => 'error', 'message' => 'Сталася помилка під час відправки повідомлення']);
    }
}
