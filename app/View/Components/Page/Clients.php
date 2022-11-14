<?php

namespace App\View\Components\Page;

use App\Models\OurClient;
use Illuminate\View\Component;

class Clients extends Component
{
    public $clients = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->clients = OurClient::published()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page.clients');
    }
}
