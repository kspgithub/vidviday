<?php

namespace App\View\Components;

use App\Models\Currency;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\TourGroup;
use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SiteHeader extends Component
{
    public $localeLinks = [];
    public $tourGroups = [];
    public $contacts = [];
    public $menu = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($localeLinks = [])
    {
        // TODO: Кеширование
        $this->localeLinks = $localeLinks;
        $this->tourGroups = TourGroup::published()->get();
        $this->contacts = Contact::get();
        $this->menu = Cache::rememberForever('header-menu', function () {
            return Menu::whereSlug('header')
                ->with([
                    'items' => fn ($q) => $q->published()->where('parent_id', 0),
                    'items.page' => fn ($q) => $q->select(['id', 'slug', 'published']),
                    'items.page.roles',
                    'items.children' => fn ($q) => $q->published(),
                    'items.children.page' => fn ($q) => $q->select(['id', 'slug', 'published']),
                    'items.children.page.roles',
                ])->first();
        });
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('layout.includes.header');
    }
}
