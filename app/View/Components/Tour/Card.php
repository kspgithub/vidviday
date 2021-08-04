<?php

namespace App\View\Components\Tour;

use App\Models\Tour;
use App\Models\TourSchedule;
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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tour $tour, $mode = 'thumb')
    {
        $this->mode = $mode;
        //
        $this->tour = $tour;

        $this->schedule = $tour->scheduleItems->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tour.card');
    }
}
