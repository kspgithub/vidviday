<?php

namespace App\Lib\Bitrix24\App;

use App\Lib\Bitrix24\Core\CRest;

class ActivityService
{


    public static function apiBaseMethod(): string
    {
        return 'bizproc.activity';
    }

    public static function list()
    {
        return CRest::call(self::apiBaseMethod() . '.list');
    }

    public static function add($fields = [])
    {
        return CRest::call(self::apiBaseMethod() . '.add', $fields);
    }

    public static function update($fields = [])
    {
        return CRest::call(self::apiBaseMethod() . '.update', $fields);
    }

    public static function delete($code)
    {
        return CRest::call(self::apiBaseMethod() . '.delete', ['CODE' => $code]);
    }
}
