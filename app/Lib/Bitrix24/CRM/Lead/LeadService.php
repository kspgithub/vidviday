<?php

namespace App\Lib\Bitrix24\CRM\Lead;

use App\Lib\Bitrix24\Core\Client;
use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;

/**
 * Справка https://dev.1c-bitrix.ru/rest_help/crm/leads/index.php
 */
class LeadService implements StaticServiceInterface
{
    use UseStaticService;

    public static function apiBaseMethod(): string
    {
        return 'crm.lead';
    }
}
