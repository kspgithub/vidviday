<?php

namespace App\View\Components\Sidebar;

use App\Services\TourService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{

    public $options;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

        $this->options = TourService::filterOptions();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.sidebar.filter');
    }
}
