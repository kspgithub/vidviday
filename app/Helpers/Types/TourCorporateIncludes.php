<?php

namespace App\Helpers\Types;

class TourCorporateIncludes
{

    const SUPPORT = 'support';
    const BUS = 'bus';
    const APARTMENT = 'apartment';
    const FOOD = 'food';
    const TICKET = 'ticket';
    const INSURANCE = 'insurance';

    public static function values()
    {
        return [
            [
                'text' => __('Екскурсійний супровід'),
                'value' => self::SUPPORT,
            ],
            [
                'text' => __('Проїзд у туристичному автобусі'),
                'value' => self::BUS,
            ],
            [
                'text' => __('Поселення'),
                'value' => self::APARTMENT,
            ],
            [
                'text' => __('Харчування'),
                'value' => self::FOOD,
            ],
            [
                'text' => __('Вхідні квитки'),
                'value' => self::TICKET,
            ],
            [
                'text' => __('Страхування на час подорожі'),
                'value' => self::INSURANCE,
            ],
        ];
    }
}
