<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Accommodation;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourAccommodation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * @property TourAccommodation $model
 */
class TourAccommodations extends Component
{
    use EditRecordTrait;
    use WithFileUploads;

    protected $listeners = [
        'updateType' => 'syncType',
    ];

    /**
     * @var Tour
     */
    public $tour;

    public $types = [];

    public $accommodations = [];

    public $countries = [];

    public $regions = [];

    public $cities = [];

    public array $form = [
        'type_id' => null,
        'country_id' => 0,
        'region_id' => 0,
        'city_id' => 0,
        'accommodation_id' => 0,
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'text' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'nights' => '',
    ];

    /**
     * @var Accommodation
     */
    public $accommodation;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourAccommodation::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourAccommodation::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->countries = Country::query()->orderBy('title')->toSelectBox();
        $this->regions = Region::query()->orderBy('title')->toSelectBox();
        $this->cities = collect();
        $this->accommodations = collect();
    }

    public function editRecordClass(): string
    {
        return TourAccommodation::class;
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        return TourAccommodation::query()->where('tour_id', $this->tour->id)
            ->with('accommodation')
            ->orderBy('position');
    }

    protected function rules()
    {
        $rules = [];

        if($this->form['type_id'] == TourAccommodation::TYPE_TEMPLATE) {
            $rules = [
                'form.type_id' => 'required',
                'form.accommodation_id' => ['required', 'int', 'min:1'],
            ];
        }

        if($this->form['type_id'] == TourAccommodation::TYPE_CUSTOM) {
            $rules = [
                'form.type_id' => 'required',
//            'form.country_id' => ['required', 'integer', Rule::exists('countries', 'id')],
//            'form.region_id' => ['required', 'integer', Rule::exists('regions', 'id')],
//            'form.city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
            ];

            $locales = $this->tour->locales;

            foreach ($locales as $locale) {
                $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourAccommodation::TYPE_CUSTOM, ['required', 'string']);
            }

        }

        return $rules;
    }

    public function render()
    {
//        if ($this->form['country_id']) {
//            $country = Country::query()->find($this->form['country_id']);
//            $this->countries = collect([$country->asSelectBox()]);
//        }
        if ($this->form['region_id']) {
            $region = Region::query()->find($this->form['region_id']);
            $this->regions = collect([$region->asSelectBox()]);
        }
        if ($this->form['city_id']) {
            $city = City::query()->find($this->form['city_id']);
            $this->cities = collect([$city->asSelectBox()]);
        }
        if ($this->form['accommodation_id']) {
            $accommodation = Accommodation::query()->find($this->form['accommodation_id']);
            $this->accommodations = collect([$accommodation->asSelectBox()]);
        }

        return view('admin.tour.accommodation.livewire', ['items' => $this->tour->groupTourAccommodations]);
    }

    public function updatedFormCountryId($country_id)
    {
        $this->form['region_id'] = 0;
        $this->form['city_id'] = 0;


        if($this->model->accommodation?->country_id)
            $this->form['accommodation_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormRegionId($region_id)
    {
        if ($region_id) {
            $region = Region::query()->find($region_id);
            $this->form['country_id'] = $region->country_id;
        }

        $this->form['city_id'] = 0;

        if($this->model->accommodation?->region_id)
            $this->form['accommodation_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormCityId($city_id)
    {
        if ($city_id) {
            $city = City::query()->find($city_id);
            $this->form['region_id'] = $city->region_id;
            $this->form['country_id'] = $city->country_id;
        }

        if($this->model->accommodation?->city_id)
            $this->form['accommodation_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormAccommodationId($accommodation_id)
    {
        if ($accommodation_id) {
            $accommodation = Accommodation::query()->with(['country', 'region', 'city'])->find($this->form['accommodation_id']);
            $this->form['country_id'] = $accommodation->country_id ?: $accommodation->region?->country_id;
            $this->form['region_id'] = $accommodation->region_id ?: $accommodation->city?->region_id;
            $this->form['city_id'] = $accommodation->city_id;
        }
    }

    public function updatedFormTypeId($type_id)
    {
        if($type_id == TourAccommodation::TYPE_CUSTOM) {
            $this->form['accommodation_id'] = 0;
        }

        if(!$this->type) {
            $this->type = $type_id;

            $this->form['country_id'] = 0;
            $this->form['region_id'] = 0;
            $this->form['city_id'] = 0;

            $this->updatedFormCountryId($this->form['country_id']);
            $this->updatedFormRegionId($this->form['region_id']);
            $this->updatedFormCityId($this->form['city_id']);
            $this->updatedFormAccommodationId($this->form['accommodation_id']);

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_accommodations')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function updateActiveTabs($tab)
    {
        $active_tabs = $this->tour->active_tabs;

        $index = array_search($tab, $active_tabs);

        if($index !== false) {
            array_splice($active_tabs, $index);
        } else {
            $active_tabs[] = $tab;
        }

        $this->tour->active_tabs = $active_tabs;
        $this->tour->save();

        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Updated']);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->food_id > 0 ? TourAccommodation::TYPE_TEMPLATE : TourAccommodation::TYPE_CUSTOM) : $this->model->type_id;
        $this->type = $this->model->type_id;
        $this->form['accommodation_id'] = $this->model->accommodation_id === null ? 0 : $this->model->accommodation_id;
        $this->accommodation = Accommodation::query()->with(['country', 'region', 'city'])->find($this->model->accommodation_id);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['text'] = $this->model->getTranslations('text');
        $this->form['nights'] = $this->model->nights;
        $this->form['country_id'] = $this->model->country_id ?: $this->model->accommodation?->country_id;
        $this->form['region_id'] = $this->model->region_id ?: $this->model->accommodation?->region_id;
        $this->form['city_id'] = $this->model->city_id ?: $this->model->accommodation?->city_id;
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->accommodation_id = $this->form['accommodation_id'] === 0 ? null : $this->form['accommodation_id'];
        $this->model->title = $this->form['title'];
        $this->model->text = $this->form['text'];
        $this->model->nights = $this->form['nights'];
        $this->model->country_id = $this->form['country_id'] === 0 ? null : $this->form['country_id'];
        $this->model->region_id = $this->form['region_id'] === 0 ? null : $this->form['region_id'];
        $this->model->city_id = $this->form['city_id'] === 0 ? null : $this->form['city_id'];
    }

    public function updatedAccommodationId($id)
    {
        if($id) {
            $this->accommodation = Accommodation::query()->with(['country', 'region', 'city'])->find($id);
            $this->form['country_id'] = $this->accommodation->country_id ?: $this->accommodation->region?->country_id;
            $this->form['region_id'] = $this->accommodation->region_id ?: $this->accommodation->city?->region_id;
            $this->form['city_id'] = $this->accommodation->city_id;
        }
    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
