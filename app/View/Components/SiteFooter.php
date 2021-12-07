<?php

namespace App\View\Components;

use App\Models\Contact;
use App\Models\Menu;
use Illuminate\View\Component;

class SiteFooter extends Component
{

    public Contact $contact;
    public $menu = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Кеширование
        $this->contact = Contact::first();
        $this->menu = Menu::whereSlug('footer')->with(['items' => fn($q) => $q->where('parent_id', 0), 'items.children'])->first();
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
