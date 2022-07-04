<?php

namespace App\View\Components\Sidebar;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Recommendations extends Component
{
    public $items;

    public function __construct(Page $page)
    {
        $this->items = $page->recommendations()->where('published', 1)->get();
    }

    public function render(): View
    {
        return view('components.sidebar.recommendations');
    }
}
