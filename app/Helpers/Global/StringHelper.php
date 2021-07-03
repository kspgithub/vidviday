<?php

/*
echo plural_form(42, array('арбуз', 'арбуза', 'арбузов'));
*/

if (!function_exists('plural_form')) {
    function plural_form($n, $forms)
    {
        return $n%10 == 1 && $n%100 != 11 ? $forms[0] : ($n%10 >= 2 && $n%10 <= 4 && ($n%100 < 10 || $n%100 >= 20) ? $forms[1] : $forms[2]);
    }
}

if (!function_exists('clear_phone')) {
    function clear_phone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        return '+'.$phone;
    }
}

if (!function_exists('str_slug')) {
    /**
     * @param $title
     * @param string $separator
     * @param string $language
     *
     * @return string
     */
    function str_slug($title, $separator = '-', $language = 'en')
    {
        return \Illuminate\Support\Str::slug($title, $separator, $language);
    }
}

if (!function_exists('str_limit')) {
    /**
     * @param string $value
     * @param int $limit
     * @param string $ends
     *
     * @return string
     */
    function str_limit($value, $limit = 100, $ends = '...')
    {
        return \Illuminate\Support\Str::limit($value, $limit, $ends);
    }
}

if (!function_exists('to_currency')) {
    /**
     * @param $title
     * @param string $separator
     * @param string $language
     *
     * @return string
     */
    function to_currency($value, $currency = 'UAH')
    {
        return number_format($value, 2, '.', ' ').' '.$currency;
    }
}

if (!function_exists('class_short_name')) {
    function class_short_name($class_name)
    {
        return substr(strrchr($class_name, "\\"), 1);
    }
}
