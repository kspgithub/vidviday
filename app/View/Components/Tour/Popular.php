<?php

namespace App\View\Components\Tour;

use App\Models\Tour;
use App\Services\TourService;
use Cache;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Component;

class Popular extends Component
{
    public $popularTours = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->popularTours = Cache::remember('popular-tours', 1, function () {
            return TourService::popularTours();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.tour.popular');
    }
}
