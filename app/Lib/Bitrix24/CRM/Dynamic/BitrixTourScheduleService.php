<?php

namespace App\Lib\Bitrix24\CRM\Dynamic;

class BitrixTourScheduleService extends DynamicService
{
    public const ENTITY_TYPE_ID = 168;

    public static function additionalParams(): array
    {
        return ['entityTypeId' => self::ENTITY_TYPE_ID];
    }
}
