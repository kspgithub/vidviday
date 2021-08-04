<?php

namespace App\View\Components\Header;

use Illuminate\View\Component;

class LangDropdown extends Component
{
    public $languages = [];

    public $currentLocale = 'uk';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->languages = array_keys(config('site-settings.locale.languages'));

        $this->currentLocale = app()->getLocale();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.lang-dropdown');
    }
}
