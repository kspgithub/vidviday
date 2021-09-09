<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SwiperMedia extends Component
{
    /**
     * @var Media[]|Collection
     */
    public $slides = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($slides)
    {
        //
        $this->slides = $slides;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.swiper-media');
    }
}
