<?php

namespace App\Lib\Bitrix24\App;

use App\Lib\Bitrix24\Core\CRest;
use App\Lib\Bitrix24\Core\StaticServiceInterface;
use App\Lib\Bitrix24\Core\UseCRestService;

class ActivityService implements StaticServiceInterface
{
    use UseCRestService;

    public static function apiBaseMethod(): string
    {
        return 'bizproc.activity';
    }


    public static function add($fields = [], $params = [])
    {
        return CRest::call(self::apiBaseMethod() . '.add', $fields);
    }
}
