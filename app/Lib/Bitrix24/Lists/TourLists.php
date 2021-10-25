<?php

namespace App\Lib\Bitrix24\Lists;

use App\Lib\Bitrix24\Core\Client;
use App\Lib\Bitrix24\Core\StaticServiceInterface;

/**
 * Реєстр турів
 */
class TourLists
{
    public const BLOCK_ID = 35;

    /**
     * @return TourItem[]
     */
    public static function getAll()
    {
        $response = Client::get('lists.element.get', [
            'IBLOCK_TYPE_ID' => 'lists',
            'IBLOCK_ID' => self::BLOCK_ID,
        ]);

        return TourItem::fromJsonList($response['result']);
    }
}
