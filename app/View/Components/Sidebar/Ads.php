<?php

namespace App\View\Components\Sidebar;

use App\Models\Advertisement;
use Illuminate\View\Component;

class Ads extends Component
{

    public $advertisement = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->advertisement = Advertisement::published()->orderBy('created_at', 'desc')->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.ads');
    }
}
