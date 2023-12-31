<?php

namespace App\View\Components\Tour;

use App\Models\Tour;
use App\Models\TourSchedule;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * @var string['thumb', 'item']
     */
    public $mode;

    /**
     * @var Tour
     */
    public $tour;


    /**
     * @var TourSchedule
     */
    public $schedule;


    public $vue = false;


    public $history = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tour $tour, $mode = 'thumb', $vue = false, $history = false)
    {
        if(!array_key_exists('testimonials_avg_rating', $tour->getAttributes())) {
            $tour->loadAvg('testimonials', 'rating');
        }

        $this->mode = $mode;
        //
        $this->tour = $tour;

        $this->vue = $vue;

        $this->history = $history;

        $this->schedule = $tour->scheduleItems->first() ?: $tour->scheduleItems()->getRelated()->newInstance();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.tour.card');
    }
}
