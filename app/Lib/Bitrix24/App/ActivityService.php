<?php

namespace App\Lib\Bitrix24\App;

use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseStaticService;

class ActivityService implements StaticServiceInterface
{
    use UseStaticService;

    public static function apiBaseMethod(): string
    {
        return 'bizproc.activity';
    }

}
