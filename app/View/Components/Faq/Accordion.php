<?php

namespace App\View\Components\Faq;

use Illuminate\View\Component;

class Accordion extends Component
{
    public $items;

    public $expand = 'first';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $expand = 'first')
    {
        //
        $this->items = $items;
        $this->expand = $expand;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.faq.accordion');
    }
}
