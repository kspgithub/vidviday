<?php

use App\Models\Currency;
use Carbon\Carbon;

if (!function_exists('setAllLocale')) {

    /**
     * @param $locale
     */
    function setAllLocale($locale)
    {
        setAppLocale($locale);
        setPHPLocale($locale);
        setCarbonLocale($locale);
        setLocaleReadingDirection($locale);
    }
}

if (!function_exists('setAppLocale')) {

    /**
     * @param $locale
     */
    function setAppLocale($locale)
    {
        app()->setLocale($locale);
    }
}

if (!function_exists('setPHPLocale')) {

    /**
     * @param $locale
     */
    function setPHPLocale($locale)
    {
        setlocale(LC_TIME, $locale);
    }
}

if (!function_exists('setCarbonLocale')) {

    /**
     * @param $locale
     */
    function setCarbonLocale($locale)
    {
        Carbon::setLocale($locale);
    }
}

if (!function_exists('setLocaleReadingDirection')) {

    /**
     * @param $locale
     */
    function setLocaleReadingDirection($locale)
    {
        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (!app()->runningInConsole()) {
            if (array_key_exists($locale, config('site-settings.locale.languages')) &&
                config('site-settings.locale.languages')[$locale]['rtl']) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }
    }
}

if (!function_exists('getLocaleName')) {

    /**
     * @param $locale
     *
     * @return mixed
     */
    function getLocaleName($locale)
    {
        return array_key_exists($locale, config('site-settings.locale.languages'))
            ? config('site-settings.locale.languages')[$locale]['name']
            : config('site-settings.locale.languages')['en']['name'];
    }
}

if (!function_exists('trans')) {
    function trans($key, $replace = [])
    {
        return Lang::get($key, $replace);
    }
}
