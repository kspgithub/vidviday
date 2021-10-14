<?php

namespace App\View\Components\Sidebar;

use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\View\Component;

class LatestTestimonials extends Component
{
    public $testimonials = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->testimonials =  Testimonial::moderated()->where('model_type', Tour::class)->latest()->take(2)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.latest-testimonials');
    }
}
