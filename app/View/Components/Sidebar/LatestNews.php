<?php

namespace App\View\Components\Sidebar;

use App\Models\News;
use Illuminate\View\Component;

class LatestNews extends Component
{
    public $news = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->news = News::published()->latest()->take(3)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.latest-news');
    }
}
