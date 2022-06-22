<?php

namespace App\Services;

use App\Mail\CustomEmail;
use App\Mail\OrderCertificateAdminMail;
use App\Mail\OrderCertificateMail;
use App\Mail\OrderStatusEmail;
use App\Mail\OrderTransportAdminMail;
use App\Mail\OrderTransportMail;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Models\HtmlBlock;
use App\Models\Order;
use App\Models\OrderCertificate;
use App\Models\OrderTransport;
use App\Models\Staff;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailNotificationService
{
    public static function adminTourOrder(Order $order)
    {
        try {
            Mail::send(new TourOrderAdminEmail($order));
            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function userTourOrder(Order $order)
    {
        try {
            if (!empty($order->email)) {
                Mail::to($order->email)->send(new TourOrderEmail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function userOrderStatus(Order $order, $notifyEmail, $notifyMessage)
    {
        try {
            Mail::to($notifyEmail)->send(new OrderStatusEmail($order, $notifyMessage));
            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function customMail($email, $message, $subject = 'Нове повідомлення')
    {
        try {
            Mail::to($email)->send(new CustomEmail($message, $subject));
            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }


    public static function getAdminCertificateEmails()
    {
        $emails = [site_option('certificate_email')];
        $staff = Staff::query()->whereHas('types', fn ($sq) => $sq->where('slug', 'certificate-manager'))->get();
        foreach ($staff as $st) {
            if (!empty($st->email)) {
                $emails[] = $st->email;
            }
        }
        return array_unique(array_filter($emails));
    }

    public static function userCertificateEmail(OrderCertificate $order)
    {
        try {
            if (!empty($order->email)) {
                Mail::to($order->email)->send(new OrderCertificateMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function adminCertificateEmail(OrderCertificate $order)
    {
        try {
            $emails = MailNotificationService::getAdminCertificateEmails();
            if (!empty($emails)) {
                Mail::to($emails)->send(new OrderCertificateAdminMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }


    public static function getAdminTransportEmails()
    {
        $emails = [site_option('transport_email')];
//        $staff = Staff::query()->whereHas('types', fn ($sq) => $sq->where('slug', 'certificate-manager'))->get();
//        foreach ($staff as $st) {
//            if (!empty($st->email)) {
//                $emails[] = $st->email;
//            }
//        }
        return array_unique(array_filter($emails));
    }

    public static function getAdminNotifyEmails()
    {
        $emails = [site_option('notify_email')];
        return array_unique(array_filter($emails));
    }

    public static function userTransportEmail(OrderTransport $order)
    {
        try {
            if (!empty($order->email)) {
                Mail::to($order->email)->send(new OrderTransportMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }


    public static function adminTransportEmail(OrderTransport $order)
    {
        try {
            $emails = MailNotificationService::getAdminTransportEmails();
            if (!empty($emails)) {
                Mail::to($emails)->send(new OrderTransportAdminMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }
}
