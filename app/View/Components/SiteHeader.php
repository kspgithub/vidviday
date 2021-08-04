<?php

namespace App\View\Components;

use App\Models\Currency;
use App\Models\TourGroup;
use Illuminate\View\Component;

class SiteHeader extends Component
{

    public $tourGroups = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Кеширование
        $this->tourGroups = TourGroup::published()->get();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layout.includes.header');
    }
}
