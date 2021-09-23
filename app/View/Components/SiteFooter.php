<?php

namespace App\View\Components;

use App\Models\Contact;
use Illuminate\View\Component;

class SiteFooter extends Component
{

    public $contacts = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Кеширование
        $this->contacts = Contact::all();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layout.includes.footer');
    }
}
