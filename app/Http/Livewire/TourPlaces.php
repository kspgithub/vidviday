<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\City;
use App\Models\Direction;
use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourPlace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TourPlaces extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var Collection
     */
    public $types;

    /**
     * @var Collection
     */
    public $directions;

    /**
     * @var Collection
     */
    public $regions;

    /**
     * @var Collection
     */
    public $districts;

    /**
     * @var Collection
     */
    public $cities;

    /**
     * @var Collection
     */
    public $places;


    /**
     * @var int
     */
    public $type_id = null;

    /**
     * @var int
     */
    public $region_id = 0;

    /**
     * @var int
     */
    public $district_id = 0;

    /**
     * @var int
     */
    public $city_id = 0;

    /**
     * @var int
     */
    public $place_id = 0;

    /**
     * @var array
     */
    public $title = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];

    /**
     * @var array
     */
    public $text = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];

    public $lat = 48.736383466532274;
    public $lng = 31.460746106250006;

    /**
     * @var Place
     */
    public $place;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourPlace::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourPlace::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->directions = Direction::query()->orderBy('title')->toSelectBox();
        $this->regions = Region::query()->orderBy('title')->toSelectBox();
        $this->districts = collect();
        $this->cities = collect();
        $this->places = collect();
        $this->place = null;
    }

    public function editRecordClass(): string
    {
        return TourPlace::class;
    }

    public function query(): Builder|Relation
    {
        return $this->tour->tourPlaces()->with(['place']);
    }

    protected function rules()
    {
        $rules = [
            'type_id' => 'required',
            'place_id' => Rule::when(fn() => $this->type_id == TourPlace::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
            'title' => Rule::when(fn() => $this->type_id == TourPlace::TYPE_CUSTOM, ['required', 'array']),
            'text' => Rule::when(fn() => $this->type_id == TourPlace::TYPE_CUSTOM, ['required', 'array']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['title.' . $locale] = Rule::when(fn() => $this->type_id == TourPlace::TYPE_CUSTOM, ['required', 'string']);
            $rules['text.' . $locale] = Rule::when(fn() => $this->type_id == TourPlace::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        if($this->district_id) {
            $district = District::query()->find($this->district_id);
            $this->districts = collect([$district->asSelectBox()]);
        }
        if($this->city_id) {
            $city = City::query()->find($this->city_id);
            $this->cities = collect([$city->asSelectBox()]);
        }
        if($this->place_id) {
            $place = Place::query()->find($this->place_id);
            $this->places = collect([$place->asSelectBox()]);
        }

        return view('admin.tour.places.livewire', [
            'items' => $this->query()->orderBy('position')->get()
        ]);
    }

    public function updatedTypeId($type_id)
    {
        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updatedRegionId($region_id)
    {
        $this->district_id = 0;
        $this->city_id = 0;
        $this->place_id = 0;

        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updatedDistrictId($district_id)
    {
        if($district_id) {
            $district = District::query()->find($district_id);
            $this->region_id = $district->region_id;
        }
        $this->city_id = 0;
        $this->place_id = 0;

        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updatedCityId($city_id)
    {
        if($city_id) {
            $city = City::query()->with(['district', 'region', 'country'])->find($city_id);

            $this->region_id = $city->region_id;
            $this->district_id = $city->district_id;

            $address = implode(' ', [$city->region->title, $city->district->title, $city->title]);
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['address' => $address ?? '']);
    }

    public function updatedPlaceId($place_id)
    {
        if($place_id) {
            $this->place = Place::query()->find($this->place_id);
            $this->region_id = $this->place->region_id;
            $this->city_id = $this->place->city_id;
            $this->district_id = $this->place->district_id;
        }
    }

    public function updatedLat($lat)
    {
        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updatedLng($lng)
    {
        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updatedSelectedId($id)
    {
        $this->dispatchBrowserEvent('livewire-refresh', []);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_places')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->type_id;
        $this->model->region_id = $this->region_id;
        $this->model->district_id = $this->district_id;
        $this->model->city_id = $this->city_id;
        $this->model->place_id = $this->place_id;
        $this->model->title = $this->title;
        $this->model->text = $this->text;
        $this->model->lat = $this->lat;
        $this->model->lng = $this->lng;
    }

    public function afterSaveItem()
    {
        $this->type_id = 0;
        $this->region_id = 0;
        $this->district_id = 0;
        $this->city_id = 0;
        $this->place_id = 0;
        $this->title = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->text = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->lat = 48.736383466532274;
        $this->lng = 31.460746106250006;
    }

    public function afterModelInit()
    {
        $this->type_id = $this->model->type_id === 0 ? ($this->model->place_id > 0 ? TourPlace::TYPE_TEMPLATE : TourPlace::TYPE_CUSTOM) : $this->model->type_id;
        $this->region_id = $this->model->region_id ?? 0;
        $this->district_id = $this->model->district_id ?? 0;
        $this->city_id = $this->model->city_id ?? 0;
        $this->place_id = $this->model->place_id ?? 0;
        $this->place = Place::query()->find($this->place_id);
        $this->title = $this->model->getTranslations('title');
        $this->text = $this->model->getTranslations('text');
        $this->lat = $this->model->lat;
        $this->lng = $this->model->lng;

        $this->dispatchBrowserEvent('livewire-refresh', []);

    }
}
