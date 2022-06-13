<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Food;
use App\Models\FoodTime;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourFood;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * @property TourFood|null $model
 */
class TourFoods extends Component
{
    use EditRecordTrait;
    use WithFileUploads;

    protected $listeners = [
        'locationChanged' => 'syncLocation',
        'updateType' => 'syncType',
    ];

    /**
     * @var Tour
     */
    public $tour;

    public $types;

    public $foodItems = [];

    public $foodTimes = [];

    public $countries = [];

    public $regions = [];

    public $pictures = [];

    public $currencies = [];

    public array $form = [
        'type_id' => null,
        'country_id' => 0,
        'region_id' => 0,
        'food_id' => 0,
        'time_id' => 1,
        'day' => 1,
        'price' => 0,
        'currency' => 'UAH',
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'text' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
    ];

    /**
     * @var Food
     */
    public $food;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourFood::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourFood::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->foodTimes = FoodTime::toSelectBox();
        $this->foodItems = Food::toSelectBox();
        $this->countries = Country::toSelectBox();
        $this->regions = Region::toSelectBox();
        $this->currencies = Currency::toSelectBox('iso', 'iso');
    }

    public function editRecordClass(): string
    {
        return TourFood::class;
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        return TourFood::query()->where('tour_id', $this->tour->id)
            ->with(['time', 'food'])
            ->orderBy('position')->orderBy('day')->orderBy('time_id');
    }

    protected function rules()
    {
        $rules = [
            'form.type_id' => 'required',
            'form.day' => ['required', 'numeric', 'min:1', 'max:' . $this->tour->duration],
            'form.country_id' => ['required', 'integer', Rule::exists('countries', 'id')],
            'form.region_id' => ['required', 'integer', Rule::exists('regions', 'id')],
            'form.food_id' => Rule::when(fn() => $this->form['type_id'] == TourFood::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
            'form.time_id' => ['required', 'integer', Rule::exists('food_times', 'id')],
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourFood::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

//    public function getFoodsProperty()
//    {
//        $query = Food::query();
//        if ($this->form['country_id'] > 0) {
//            $query->where('country_id', $this->form['country_id']);
//        }
//        if ($this->form['region_id'] > 0) {
//            $query->where('region_id', $this->form['region_id']);
//        }
//        if ($this->form['time_id'] > 0) {
//            $query->where('time_id', $this->form['time_id']);
//        }
//        return $query->toSelectBox();
//    }

    public function render()
    {
        return view('admin.tour.food.livewire', ['items' => $this->query()->get()]);
    }

    public function updatedFormCountryId($country_id)
    {
        $this->form['region_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormRegionId($region_id)
    {
        if ($region_id) {
            $region = Region::query()->find($region_id);
            $this->form['country_id'] = $region->country_id;
        }

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormFoodId($food_id)
    {
        if ($food_id) {
            $food = Food::query()->with(['country', 'region'])->find($this->form['food_id']);
            $this->form['country_id'] = $food->country_id ?: $food->region?->country_id;
            $this->form['region_id'] = $food->region_id;
        }
    }

    public function updatedFormTypeId($type_id)
    {
        if(!$this->type) {
            $this->type = $type_id;

            $this->form['country_id'] = 0;
            $this->form['region_id'] = 0;

            $this->updatedFormCountryId($this->form['country_id']);
            $this->updatedFormRegionId($this->form['region_id']);
            $this->updatedFormFoodId($this->form['food_id']);

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_food')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->food_id > 0 ? TourFood::TYPE_TEMPLATE : TourFood::TYPE_CUSTOM) : $this->model->type_id;
        $this->form['food_id'] = $this->model->food_id === null ? 0 : $this->model->food_id;
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['text'] = $this->model->getTranslations('text');
        $this->form['country_id'] = $this->model->country_id ?: $this->model->food?->country_id;
        $this->form['region_id'] = $this->model->region_id ?: $this->model->food?->region_id;
        $this->form['day'] = $this->model->day;
        $this->form['food_id'] = $this->model->food_id === null ? 0 : $this->model->food_id;
        $this->form['time_id'] = $this->model->time_id;
        $this->form['price'] = $this->model->price;
        $this->form['currency'] = $this->model->currency;
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->food_id = $this->form['food_id'] === 0 ? null : $this->form['food_id'];
        $this->model->title = $this->form['title'];
        $this->model->text = $this->form['text'];
        $this->model->country_id = $this->form['country_id'] === 0 ? null : $this->form['country_id'];
        $this->model->region_id = $this->form['region_id'] === 0 ? null : $this->form['region_id'];
        $this->model->day = $this->form['day'];
        $this->model->time_id = $this->form['time_id'];
        $this->model->price = $this->form['price'];
        $this->model->currency = $this->form['currency'];
    }

    public function updatedFoodId($id)
    {
        if($id) {
            $food = Food::query()->with(['country', 'region'])->find($id);
            $this->form['country_id'] = $food->country_id ?: $food->region?->country_id;
            $this->form['region_id'] = $food->region_id;
        }
    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
