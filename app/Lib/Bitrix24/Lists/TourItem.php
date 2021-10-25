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
     * Менеджер туру
     * ID в CRM
     */
    public const PROPERTY_MANAGER_ID = 'PROPERTY_116';


    public $id;

    public $name;

    public $duration;

    public $price;

    public $currency;

    public $manager_id;


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
