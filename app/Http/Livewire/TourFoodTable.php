<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\FoodTime;
use App\Models\Tour;
use App\Models\TourFood;
use App\Models\TourPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * @property TourFood|null $model
 */
class TourFoodTable extends Component
{
    use EditRecordTrait;
    use WithFileUploads;


    /**
     * @var Tour
     */
    public $tour;

    public $locales = [];

    public $foodTimes = [];

    public $pictures = [];

    public $day = 1;

    public $time_id = 1;

    public $text_uk = '';
    public $text_ru = '';
    public $text_en = '';
    public $text_pl = '';


    protected function getRules()
    {
        return [
            'text_uk' => ['required'],
            'text_ru' => ['nullable'],
            'text_en' => ['nullable'],
            'text_pl' => ['nullable'],
            'day' => ['required', 'numeric', 'min:1', 'max:' . $this->tour->duration],
            'time_id' => ['required', 'integer', Rule::exists('food_times', 'id')],
            'pictures.*' => ['image', 'max:2048'],
        ];
    }


    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->locales = $this->getLocales();
        $this->foodTimes = FoodTime::toSelectBox();
        $this->day = 1;
        $this->time_id = 1;
    }

    public function render()
    {
        return view('admin.tour.includes.tour-food', ['items' => $this->query()->get()]);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return TourFood::query()->where('tour_id', $this->tour->id)
            ->with(['time', 'media'])
            ->withCount(['media'])->orderBy('day')->orderBy('time_id');
    }

    public function afterModelInit()
    {
        $this->day = $this->model->day ?? 1;
        $this->time_id = $this->model->time_id ?? 1;
        $this->getTranslations('text');
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->day = $this->day;
        $this->model->time_id = $this->time_id;
        $this->setTranslations('text');
    }

    public function afterSaveItem()
    {
        if (!empty($this->pictures)) {
            foreach ($this->pictures as $picture) {
                $this->model->storeMedia($picture);
            }
        }
    }

    public function editRecordClass(): string
    {
        return TourFood::class;
    }
}
