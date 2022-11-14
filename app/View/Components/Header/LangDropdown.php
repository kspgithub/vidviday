<?php

namespace App\View\Components\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class LangDropdown extends Component
{
    public $localeLinks = [];

    public $languages = [];

    public $currentLocale = 'uk';

    public $class = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($localeLinks = [], $class = '')
    {
        //
        $this->languages = siteLocales();
        $this->currentLocale = app()->getLocale();
        if (empty($localeLinks)) {
            $path = request()->path();
            $params = request()->except(['lang', 'page']);
            $locales = siteLocales();
            foreach ($locales as $locale) {
                $allParams = array_merge($params, ['lang' => $locale]);
                $url = $path.'?'.Arr::query($allParams);
                $localeLinks[$locale] = url($url);
            }
        }
        $this->localeLinks = $localeLinks;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.header.lang-dropdown');
    }
}
