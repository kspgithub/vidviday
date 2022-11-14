<?php

namespace App\Lib\Bitrix24\Core;

interface StaticServiceInterface
{
    public static function apiBaseMethod(): string;

    public static function additionalParams(): array;

    public static function fields(array $params = []);

    public static function list(array $select, array $filter, array $order);

    public static function get($id, array $params = []);

    public static function add(array $fields, array $params);

    public static function update($id, $fields, $params);
}
