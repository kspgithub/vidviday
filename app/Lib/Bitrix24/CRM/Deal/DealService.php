<?php

namespace App\Lib\Bitrix24\CRM\Deal;

use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;

class DealService implements StaticServiceInterface
{
    use UseStaticService;

    public static function apiBaseMethod(): string
    {
        return 'crm.deal';
    }


    public static function getByCategory($id, array $select = ['*', 'UF_*'], array $filter = [], array $order = [], $start = null)
    {
        $filter = array_merge($filter, ['CATEGORY_ID' => [$id]]);
        return self::list($select, $filter, $order, $start);
    }
}
