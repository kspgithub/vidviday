<?php

namespace App\Services;

use App\Jobs\SendSms;
use App\Models\Order;
use App\Models\OrderCertificate;
use App\Models\SmsNotification;
use App\Models\Staff;
use App\Models\Testimonial;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SmsNotificationService
{
    public static function registerTourAgent(User $user)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'register-tour-agent')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.register-tour-agent.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = Staff::query()->whereHas('types', function ($q) {
                    return $q->where('slug', 'travel-agencies');
                })->get();

                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function tourOrder(Order $order)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'order')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.order.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = array_filter([$order->tour->manager]);

                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function orderOneClick(Order $order)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'order-one-click')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.order-one-click.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = array_filter([$order->tour->manager]);

                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function userOrderNotification(Order $order)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'order-user')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.order-user.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                if ($order->phone && $smsNotification->phone) {
                    dispatch(new SendSms($order->phone, $text));
                }
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function staffTestimonial(Staff $staff, Testimonial $testimonial)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'staff-testimonial')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.staff-testimonial.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = array_filter([$staff]);

                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function orderCorporate(Order $corporate)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'corporate')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.corporate.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = array_filter([$corporate->tour->manager]);

                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }

    public static function orderCertificate(OrderCertificate $certificate)
    {
        try {
            // Notify staff via sms
            $smsNotification = SmsNotification::query()->where('key', 'certificate')->first();

            if ($smsNotification) {

                $text = $smsNotification->text;
                $replaces = config('notifications.sms.certificate.replaces');

                foreach ($replaces as $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $search_text = '{{' . $value . '}}';
                    $replace_text = $target->{$attribute};
                    $text = Str::replace($search_text, $replace_text, $text);
                }

                $staffs = array_filter([$certificate->tour->manager]);
                self::sendMessageToStaffs($staffs, $text, $smsNotification->phone, $smsNotification->viber);

            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }


    protected static function sendMessageToStaffs($staffs, $text, $sendPhone = true, $sendViber = true)
    {

        foreach ($staffs as $staff) {
            if ($staff->phone && $sendPhone) {
                // Фикс когда указано несколько телефонов через запятую
                $phones = array_filter(explode(',', $staff->phone));
                foreach ($phones as $phone) {
                    $phone = trim($phone);
                    if (!empty($phone)) {
                        dispatch(new SendSms($phone, $text));
                    }
                }
            }

            if ($staff->viber && $sendViber) {
                dispatch(new SendSms($staff->viber, $text, 'viber'));
            }
        }
    }
}
