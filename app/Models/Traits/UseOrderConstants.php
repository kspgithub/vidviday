<?php

namespace App\Models\Traits;

trait UseOrderConstants
{

    public static $confirmations = [
        self::CONFIRMATION_EMAIL => [
            'uk' => 'Електронна пошта',
            'ru' => 'Электронная почта',
            'en' => 'E-mail',
            'pl' => 'E-mail',
        ],
        self::CONFIRMATION_VIBER => [
            'uk' => 'Viber-повідомлення',
            'ru' => 'Viber-сообщение',
            'en' => 'Viber message',
            'pl' => 'Wiadomości Viber',
        ],
        self::CONFIRMATION_PHONE => [
            'uk' => 'Телефонний дзвінок',
            'ru' => 'Телефонный звонок',
            'en' => 'Telephone call',
            'pl' => 'Rozmowa telefoniczna',
        ]
    ];


    public static function confirmationSelectBox()
    {
        $items = [];
        $locale = app()->getLocale();
        foreach (self::$confirmations as $key => $title) {
            $items[] = [
                'value' => $key,
                'text' => $title[$locale] ?? $title['uk'],
            ];
        }
        return $items;
    }


    public static function statuses()
    {
        return [
            self::STATUS_NEW => __('order-section.status.new'),
            self::STATUS_BOOKED => __('order-section.status.booked'),
            self::STATUS_NOT_SENT => __('order-section.status.not-sent'),
            self::STATUS_INTERESTED => __('order-section.status.interested'),
            self::STATUS_RESERVE => __('order-section.status.reserve'),
            self::STATUS_DEPOSIT => __('order-section.status.deposit'),
            self::STATUS_PAYED => __('order-section.status.payed'),
            self::STATUS_PENDING_CANCEL => __('order-section.status.pending-cancel'),
            self::STATUS_CANCELED => __('order-section.status.canceled'),
            self::STATUS_COMPLETED => __('order-section.status.completed'),
        ];
    }

    public static function status_classes()
    {
        return [
            self::STATUS_NEW => self::STATUS_NEW,
            self::STATUS_BOOKED => self::STATUS_BOOKED,
            self::STATUS_NOT_SENT => self::STATUS_NOT_SENT,
            self::STATUS_INTERESTED => self::STATUS_INTERESTED,
            self::STATUS_RESERVE => self::STATUS_RESERVE,
            self::STATUS_DEPOSIT => self::STATUS_DEPOSIT,
            self::STATUS_PAYED => self::STATUS_PAYED,
            self::STATUS_PENDING_CANCEL => self::STATUS_PENDING_CANCEL,
            self::STATUS_CANCELED => self::STATUS_CANCELED,
            self::STATUS_COMPLETED => self::STATUS_COMPLETED,
        ];
    }

    public static function includes()
    {
        return [
            'support' => __('order-section.includes.support'),
            'bus' => __('order-section.includes.bus'),
            'apartment' => __('order-section.includes.apartment'),
            'food' => __('order-section.includes.food'),
            'ticket' => __('order-section.includes.ticket'),
            'insurance' => __('order-section.includes.insurance'),
        ];
    }

    public static function orderInclude($key)
    {
        $includes = self::includes();
        return array_key_exists($key, $includes) ? $includes[$key] : $key;
    }


    public function getConfirmationTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->confirmation_type > 0 ? self::$confirmations[$this->confirmation_type][$locale] : '';
    }


    public function getStatusTextAttribute()
    {
        return self::statuses()[$this->status] ?? '';
    }

    public function getStatusClassAttribute()
    {
        return self::status_classes()[$this->status] ?? 'waiting';
    }

    public static $paymentStatuses = [
        self::PAYMENT_PENDING => 'Очікує на оплату',
        self::PAYMENT_COMPLETE => 'Оплачено',
        self::PAYMENT_RETURNED => 'Повернено',
    ];
}
