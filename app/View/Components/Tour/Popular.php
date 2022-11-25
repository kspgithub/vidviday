<?php

namespace App\View\Components\Tour;

use App\Models\PopularTour;
use App\Models\Tour;
use App\Services\TourService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Popular extends Component
{
    public $popularTours = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model = null)
    {
        //
        $keys = ['popular-tours'];
        if($model && $model->model_type) {
            $keys[] = Str::snake($model->model_type);
        }
        if($model && $model->model_id) {
            $keys[] = $model->model_id;
        }

        $this->popularTours = Cache::remember(implode('_', $keys), 1, function () use ($model) {
            return TourService::popularTours($model, 25, app()->getLocale());
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
