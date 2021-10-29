<?php

namespace App\Lib\Bitrix24\Lists;

class TourItem
{
    /**
     * ID Тура в CRM
     */
    public const PROPERTY_ID = 'ID';

    /**
     * Название Тура в CRM
     */
    public const PROPERTY_NAME = 'NAME';

    /**
     * Тривалість днів
     */
    public const PROPERTY_DURATION = 'PROPERTY_111';

    /**
     * Вартість
     * сумма|валюта
     */
    public const PROPERTY_PRICE = 'PROPERTY_164';

    /**
     * Комісія агента
     * сумма|валюта
     */
    public const PROPERTY_COMMISSION = 'PROPERTY_174';

    /**
     * Менеджер туру
     * ID в CRM
     */
    public const PROPERTY_MANAGER_ID = 'PROPERTY_116';

    /**
     * План туру
     */
    public const PROPERTY_PLAN = 'PROPERTY_166';

    /**
     * Примітки
     */
    public const PROPERTY_COMMENT = 'PROPERTY_168';


    public $id;

    public $name;

    public $duration;

    public $price;

    public $commission;

    public $currency;

    public $manager_id;

    public $plan;

    public $comment;


    public static function fromJsonData($json_data)
    {
        $tour = new self();
        $tour->id = (int)$json_data[self::PROPERTY_ID];
        $tour->name = $json_data[self::PROPERTY_NAME];
        $tour->duration = (int)array_values($json_data[self::PROPERTY_DURATION])[0];

        if (array_key_exists(self::PROPERTY_PRICE, $json_data)) {
            $price_parts = explode('|', array_values($json_data[self::PROPERTY_PRICE])[0]);
            $tour->price = (int)$price_parts[0] ?? 0;
            $tour->currency = $price_parts[1] ?? 'UAH';
        }

        if (array_key_exists(self::PROPERTY_COMMISSION, $json_data)) {
            $price_parts = explode('|', array_values($json_data[self::PROPERTY_COMMISSION])[0]);
            $tour->commission = (int)$price_parts[0] ?? 0;
        }

        if (array_key_exists(self::PROPERTY_PLAN, $json_data)) {
            $tour->plan = array_values($json_data[self::PROPERTY_PLAN])[0]['TEXT'];
        }

        if (array_key_exists(self::PROPERTY_COMMENT, $json_data)) {
            $tour->comment = array_values($json_data[self::PROPERTY_COMMENT])[0]['TEXT'];
        }

        $tour->manager_id = (int)array_values($json_data[self::PROPERTY_MANAGER_ID])[0];

        return $tour;
    }


    public static function fromJsonList($json_list)
    {
        $tours = [];
        foreach ($json_list as $json_data) {
            $tours[] = self::fromJsonData($json_data);
        }
        return $tours;
    }
}
