<?php

namespace App\View\Components\Sidebar;

use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class LatestTestimonials extends Component
{
    public $title = '';
    public $btnText = '';
    public $btnUrl = '';
    public $type = '';


    public $testimonials = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'Відгуки', $btnText = 'Показати всі відгуки', $type = 'tour')
    {
        //
        $this->title = $title;
        $this->btnText = $btnText;
        $testimonialsPage = Page::query()->where('key', 'testimonials')->first();
        $this->btnUrl = $testimonialsPage ? $testimonialsPage->url : route('testimonials.index');
        $this->type = $type;

        switch ($type) {
            default:
                $class = Tour::class;
                break;
        }


        $this->testimonials = Cache::remember(
            'latest__testimonials_' . $type,
            60,
            fn () => Testimonial::moderated()->when($type !== 'all', fn ($q) => $q->where('model_type', $class))->latest()->take(10)->get()
        );
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
