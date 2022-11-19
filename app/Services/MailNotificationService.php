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
use App\Models\OrderBroker;
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
            $adminEmails = MailNotificationService::getAdminNotifyEmails();
            Mail::to($adminEmails)->queue(new TourOrderAdminEmail($order));
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
                Mail::to($order->email)->queue(new TourOrderEmail($order));
            }

            if($order->confirmation_type == Order::CONFIRMATION_EMAIL && !empty($order->confirmation_contact)) {
                Mail::to($order->confirmation_contact)->queue(new TourOrderEmail($order));
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function userOrderStatus(Order $order, $notifyEmail, $notifyMessage)
    {
        try {
            Mail::to($notifyEmail)->queue(new OrderStatusEmail($order, $notifyMessage));
            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function customMail($email, $message, $subject = 'Нове повідомлення')
    {
        try {
            Mail::to($email)->queue(new CustomEmail($message, $subject));
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
                Mail::to($order->email)->queue(new OrderCertificateMail($order));
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
                Mail::to($emails)->queue(new OrderCertificateAdminMail($order));
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
                Mail::to($order->email)->queue(new OrderTransportMail($order));
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
                Mail::to($emails)->queue(new OrderTransportAdminMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    public static function userBrokerEmail(OrderBroker $order)
    {
        try {
            if (!empty($order->email)) {
                Mail::to($order->email)->queue(new OrderBrokerMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }


    public static function adminBrokerEmail(OrderBroker $order)
    {
        try {
            $emails = MailNotificationService::getAdminTransportEmails();
            if (!empty($emails)) {
                Mail::to($emails)->queue(new OrderBrokerAdminMail($order));
                return true;
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }
}
