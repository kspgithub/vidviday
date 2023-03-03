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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = Staff::query()->whereHas('types', function ($q) {
                    return $q->where('slug', 'travel-agencies');
                })->get();

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
                }
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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $text = Str::replace(['{{ order_id }}', '{{order_id}}'], $order->id, $text);

                if (!$order->email && $order->phone && $smsNotification->phone) {
                    dispatch(new SendSms($order->phone, $text));
                }

                $staffs = array_filter([$order->tour->manager]);

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
                }
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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = array_filter([$order->tour->manager]);

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = array_filter([$staff]);

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
                }
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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = array_filter([$corporate->tour->manager]);

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
                }
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

                foreach ($replaces as $replace => $value) {
                    [$variable, $attribute] = explode('_', $value);
                    $target = $$variable;
                    $text = Str::replace($replace, $target->{$attribute}, $text);
                }

                $staffs = array_filter([$certificate->tour->manager]);

                foreach ($staffs as $staff) {
                    if ($staff->phone && $smsNotification->phone) {
                        dispatch(new SendSms($staff->phone, $text));
                    }

                    if ($staff->viber && $smsNotification->viber) {
                        dispatch(new SendSms($staff->phone, $text, 'viber'));
                    }
                }
            }

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return false;
    }
}
