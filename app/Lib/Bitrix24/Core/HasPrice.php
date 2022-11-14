<?php

namespace App\Lib\Bitrix24\Core;

trait HasPrice
{
    public static function extractPrice($value = '')
    {
        $parts = array_filter(explode('|', $value));

        return isset($parts[0]) ? (int) $parts[0] : 0;
    }

    public static function extractCurrency($value = '')
    {
        $parts = array_filter(explode('|', $value));

        return $parts[1] ?? 'UAH';
    }
}
