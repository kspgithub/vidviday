<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailNotifyRequest;
use App\Mail\CustomEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CrmNotificationsController extends Controller
{
    /**
     * Отправка сообщений
     * @param MailNotifyRequest $request
     * @return JsonResponse
     */
    public function notifyEmail(MailNotifyRequest $request)
    {
        //
        $email = $request->email;
        $subject = $request->subject ?? 'Нове повідомлення';
        $message = $request->message;
        Mail::to($email)->send(new CustomEmail($message, $subject));
        return response()->json(['result' => 'success', 'message' => __('Mail Sent')]);
    }
}
