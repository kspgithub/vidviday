<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Food;
use App\Models\FoodTime;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourFood;
use App\Models\TourPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
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

    public $foodItems = [];

    public $foodTimes = [];

    public $regions = [];

    public $pictures = [];

    public $day = 1;

    public $region_id = 0;

    public $food_id = 0;

    public $time_id = 1;

    public $text_uk = '';
    public $text_ru = '';
    public $text_en = '';
    public $text_pl = '';


    protected function getRules()
    {
        return [
            'text_uk' => ['nullable'],
            'text_ru' => ['nullable'],
            'text_en' => ['nullable'],
            'text_pl' => ['nullable'],
            'day' => ['required', 'numeric', 'min:1', 'max:' . $this->tour->duration],
            'region_id' => ['required', 'integer', Rule::exists('regions', 'id')],
            'food_id' => ['required', 'integer', Rule::exists('food', 'id')],
            'time_id' => ['required', 'integer', Rule::exists('food_times', 'id')],
        ];
    }


    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->locales = $this->getLocales();
        $this->foodTimes = FoodTime::toSelectBox();
        $this->foodItems = Food::toSelectBox();
        $this->regions = Region::toSelectBox();
        $this->day = 1;
        $this->time_id = 1;
    }

    public function getFoodsProperty()
    {
        $query = Food::query();
        if ($this->region_id > 0) {
            $query->where('region_id', $this->region_id);
        }
        if ($this->time_id > 0) {
            $query->where('time_id', $this->time_id);
        }
        return $query->toSelectBox();
    }

    public function render()
    {
        return view('admin.tour.includes.tour-food', ['items' => $this->query()->get()]);
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        return TourFood::query()->where('tour_id', $this->tour->id)
            ->with(['time', 'food'])
            ->orderBy('day')->orderBy('time_id');
    }

    public function afterModelInit()
    {
        $this->getTranslations('text');
        $this->day = $this->model->day ?? 1;
        $this->food_id = $this->model->food_id ?? 0;
        $this->time_id = $this->model->time_id ?? 1;
        $this->region_id = $this->model->food->region_id ?? 0;
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->setTranslations('text');
        $this->model->day = $this->day;
        $this->model->time_id = $this->time_id;
        $this->model->food_id = $this->food_id;
    }

    public function editRecordClass(): string
    {
        return TourFood::class;
    }
}
