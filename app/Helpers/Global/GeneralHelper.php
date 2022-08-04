<?php

use App\Models\Currency;
use App\Models\Page;
use App\Models\SiteOption;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ViewErrorBag;

if (!function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (!function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     *
     * @return Carbon
     * @throws Exception
     *
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (!function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            }

            if (auth()->check()) {
                return 'profile.index';
            }
        }

        return 'frontend.index';
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path)
    {
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

if (!function_exists('current_user')) {
    /**
     * Текущий авторизованный пользователь
     *
     * @return \App\Models\User|null
     */
    function current_user()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}

if (!function_exists('is_admin')) {
    /**
     * Является текущий авторизованный пользователь админом
     *
     * @return boolean
     */
    function is_admin()
    {
        if (current_user() !== null) {
            return current_user()->isAdmin();
        }

        return false;
    }
}

if (!function_exists('is_manager')) {
    /**
     * Является текущий авторизованный пользователь админом
     *
     * @return boolean
     */
    function is_manager()
    {
        if (current_user() !== null) {
            return current_user()->isManager();
        }

        return false;
    }
}

if (!function_exists('is_tour_manager')) {
    /**
     * Является текущий авторизованный пользователь админом
     *
     * @return boolean
     */
    function is_tour_manager()
    {
        if (current_user() !== null) {
            return current_user()->isTourManager();
        }

        return false;
    }
}

if (!function_exists('is_duty_manager')) {
    /**
     * Является текущий авторизованный пользователь админом
     *
     * @return boolean
     */
    function is_duty_manager()
    {
        if (current_user() !== null) {
            return current_user()->isDutyManager();
        }

        return false;
    }
}

if (!function_exists('is_tourist')) {
    /**
     * Является текущий авторизованный пользователь туристом
     *
     * @return boolean
     */
    function is_tourist()
    {
        if (current_user() !== null) {
            return current_user()->isTourist();
        }

        return false;
    }
}

if (!function_exists('is_tour_agent')) {
    /**
     * Является текущий авторизованный пользователь Тур агентом
     *
     * @return boolean
     */
    function is_tour_agent()
    {
        if (current_user() !== null) {
            return current_user()->isTourAgent();
        }

        return false;
    }
}

if (!function_exists('validation_errors')) {
    function validation_errors($clear = true)
    {
        if ($clear) {
            return request()->session()->pull('errors') ?: new  ViewErrorBag;
        }

        return request()->session()->get('errors') ?: new  ViewErrorBag;
    }
}

if (!function_exists('site_option')) {
    /**
     * Является ли текущий пользователь админом
     *
     * @return mixed
     */
    function site_option($key, $default = null)
    {
        return SiteOption::getValue($key, $default);
    }
}

if (!function_exists('request_filter_array')) {
    /**
     * Является ли текущий пользователь админом
     *
     * @return array
     */
    function request_filter_array($key, $default = null)
    {
        return prepare_filter_param(request($key, $default));
    }
}

if (!function_exists('prepare_filter_param')) {
    /**
     * @return array
     */
    function prepare_filter_param($value)
    {
        if (is_array($value)) {
            return $value;
        } elseif (is_string($value)) {
            return array_filter(explode(',', $value));
        }

        return [];
    }
}

if (!function_exists('pusherEvent')) {
    /**
     *
     */
    function pusherEvent(...$events)
    {
        try {
            event($events);
        } catch (Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }
    }
}


if (!function_exists('currency_title')) {
    function currency_title($iso)
    {
        return Currency::currencyTitle($iso);
    }
}


if (!function_exists('arrayToSelectBox')) {
    function arrayToSelectBox($array = [])
    {
        $result = [];
        foreach ($array as $value => $text) {
            $result[] = ['value' => $value, 'text' => json_prepare($text)];
        }
        return $result;
    }
}


if (!function_exists('pageUrlByKey')) {
    function pageUrlByKey($key)
    {
        return Page::urlByKey($key);
    }
}

if (!function_exists('toastData')) {
    function toastData($errors = null)
    {
        $data = [];
        if (session()->has('flash_success')) {
            $data[] = ['type' => 'success', 'message' => session()->get('flash_success')];
        }
        if (session()->has('flash_danger')) {
            $data[] = ['type' => 'danger', 'message' => session()->get('flash_danger')];
        }
        if (isset($errors) && $errors->any()) {
            foreach ($errors->all() as $message) {
                $data[] = ['type' => 'danger', 'message' => $message];
            }
        }
        return $data;
    }
}

if (!function_exists('currency_options')) {
    function currency_options()
    {
        return Currency::toSelectBox('iso', 'iso');
    }
}


if (!function_exists('user_roles')) {
    function user_roles()
    {
        $roles = ['guest'];
        $user = current_user();
        if (!empty($user)) {
            $roles = $user->roles->pluck('name')->toArray();
        }
        return $roles;
    }
}


if (!function_exists('routeSlug')) {
    function routeSlug(string $name, array $params = [])
    {

    }
}
