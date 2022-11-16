<?php

if (!function_exists('ordinal_number')) {
    function ordinal_number(int $number, $locale = 'en')
    {
        $result = (string) $number;

        if($locale === 'en') {
            $suffix = ['st', 'nd', 'rd', 'th'];
            $lastNumber = (int) substr($number, -1);
            $result .= $suffix[$lastNumber-1] ?? 'th';
        }

        if($locale === 'ru' || $locale === 'uk') {
            $result .= '-й';
        }

        if($locale === 'pl') {
            $result .= '.';
        }

        return $result;
    }
}
