<?php

namespace App\View\Components\Sidebar;

use App\Models\Page;
use App\Models\Place;
use App\Models\Staff;
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
    public function __construct($title = 'Відгуки', $btnText = 'Показати всі відгуки', $type = 'all')
    {
        //
        $this->title = $title;
        $this->btnText = $btnText;
        $testimonialsPage = Page::query()->where('key', 'testimonials')->first();
        $this->btnUrl = $testimonialsPage ? $testimonialsPage->url : route('testimonials.index');
        $this->type = $type;

        switch ($type) {
            case 'tour':
                $class = [Tour::class];
                break;
            case 'place':
                $class = [Place::class];
                break;
            case 'all':
                $class = [Tour::class, Place::class, Staff::class];
                break;
            default:
                $class = [Tour::class, Place::class, Staff::class];
                break;
        }

        $this->testimonials = Cache::remember(
            'latest__testimonials_' . $type,
            60,
            fn () => Testimonial::moderated()->when($type !== 'all', fn ($q) => $q->whereIn('model_type', $class))
                ->where('rating', '>=', 4)
                ->orderBy('rating', 'desc')
                ->latest()
                ->take(2)->get()
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
