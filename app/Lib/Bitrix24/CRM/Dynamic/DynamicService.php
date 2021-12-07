<?php

namespace App\Lib\Bitrix24\CRM\Dynamic;

use App\Lib\Bitrix24\Core\BaseService;
use App\Lib\Bitrix24\Core\BitrixResponse;
use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;

class DynamicService implements StaticServiceInterface
{
    use UseStaticService;

    protected $entityTypeId;


    public static function apiBaseMethod(): string
    {
        return 'crm.item';
    }
    

}
