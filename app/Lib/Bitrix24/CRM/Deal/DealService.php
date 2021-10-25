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
}
