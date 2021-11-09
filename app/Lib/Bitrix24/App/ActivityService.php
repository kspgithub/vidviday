<?php

namespace App\Lib\Bitrix24\App;

use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseCRestService;

class ActivityService implements StaticServiceInterface
{
    use UseCRestService;

    public static function apiBaseMethod(): string
    {
        return 'bizproc.activity';
    }

}
