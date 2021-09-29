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

    public function getConfirmationTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->confirmation_type > 0 ? self::$confirmations[$this->confirmation_type][$locale] : '';
    }
}
