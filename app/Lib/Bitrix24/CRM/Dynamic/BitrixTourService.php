<?php

namespace App\Lib\Bitrix24\CRM\Dynamic;

class BitrixTourService extends DynamicService
{
    public const ENTITY_TYPE_ID = 167;

    public static function additionalParams(): array
    {
        return ['entityTypeId' => self::ENTITY_TYPE_ID];
    }
}
