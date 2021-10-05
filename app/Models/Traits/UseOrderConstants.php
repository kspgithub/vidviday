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
            self::STATUS_NEW => __('New'),
            self::STATUS_PROCESSING => __('Processing'),
            self::STATUS_PENDING_PAYMENT => __('Pending Payment'),
            self::STATUS_PAYED => __('Payed'),
            self::STATUS_COMPLETED => __('Completed'),
            self::STATUS_MAINTENANCE => __('Maintenance'),
            self::STATUS_PENDING_REJECT => __('Pending Reject'),
            self::STATUS_REJECTED => __('Rejected'),
        ];
    }

    public static function includes()
    {
        return [
            'support' => 'Екскурсійний супровід',
            'bus' => 'Проїзд у туристичному автобусі',
            'apartment' => 'Поселення',
            'food' => 'Харчування',
            'ticket' => 'Вхідні квитки',
            'insurance' => 'Страхування на час подорожі',
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


    public static $paymentStatuses = [
        self::PAYMENT_PENDING => 'Очікує на оплату',
        self::PAYMENT_COMPLETE => 'Оплачено',
        self::PAYMENT_RETURNED => 'Повернено',
    ];
}
