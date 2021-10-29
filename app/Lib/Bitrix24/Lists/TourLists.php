<?php

namespace App\Lib\Bitrix24\Lists;

use App\Lib\Bitrix24\Core\BitrixException;
use App\Lib\Bitrix24\Core\Client;
use App\Lib\Bitrix24\Core\StaticServiceInterface;
use Illuminate\Support\Facades\Log;

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

        if (!$response->error) {
            return TourItem::fromJsonList($response->result);
        } else {
            Log::error('Bitrix Error: ' . $response->error_description);
        }

    }
}
