<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\City;
use App\Models\Country;
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

    protected $listeners = [
        'locationChanged' => 'syncLocation',
        'updateType' => 'syncType',
    ];

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
    public $countries;

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

    public array $form = [
        'type_id' => null,
        'country_id' => 0,
        'region_id' => 0,
        'district_id' => 0,
        'city_id' => 0,
        'place_id' => 0,
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'text' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'lat' => 48.736383466532274,
        'lng' => 31.460746106250006,
    ];

    /**
     * @var Place
     */
    public $place;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourPlace::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourPlace::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->directions = Direction::query()->orderBy('title')->toSelectBox();
        $this->countries = Country::query()->orderBy('title')->toSelectBox();
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
            'form.type_id' => 'required',
            'form.place_id' => Rule::when(fn() => $this->form['type_id'] == TourPlace::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourPlace::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        if ($this->form['country_id']) {
            $country = Country::query()->find($this->form['country_id']);
            $this->countries = collect([$country->asSelectBox()]);
        }
        if ($this->form['district_id']) {
            $district = District::query()->find($this->form['district_id']);
            $this->districts = collect([$district->asSelectBox()]);
        }
        if ($this->form['city_id']) {
            $city = City::query()->find($this->form['city_id']);
            $this->cities = collect([$city->asSelectBox()]);
        }
        if ($this->form['place_id']) {
            $place = Place::query()->find($this->form['place_id']);
            $this->places = collect([$place->asSelectBox()]);
        }

        return view('admin.tour.places.livewire', [
            'items' => $this->query()->orderBy('position')->get()
        ]);
    }

    public function updatedFormTypeId($type_id)
    {
        if(!$this->type) {
            $this->type = $type_id;

            $this->form['country_id'] = 0;
            $this->form['region_id'] = 0;
            $this->form['district_id'] = 0;
            $this->form['city_id'] = 0;
            $this->form['place_id'] = 0;

            $this->updatedFormCountryId($this->form['country_id']);
            $this->updatedFormRegionId($this->form['region_id']);
            $this->dispatchBrowserEvent($this->form['district_id']);
            $this->updatedFormCountryId($this->form['country_id']);
            $this->updatedFormPlaceId($this->form['place_id']);

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updatedFormCountryId($country_id)
    {
        $this->form['region_id'] = 0;
        $this->form['district_id'] = 0;
        $this->form['city_id'] = 0;
        $this->form['place_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormRegionId($region_id)
    {
        if ($region_id) {
            $region = Region::query()->find($region_id);
            $this->form['country_id'] = $region->country_id;
        }
        $this->form['district_id'] = 0;
        $this->form['city_id'] = 0;
        $this->form['place_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormDistrictId($district_id)
    {
        if ($district_id) {
            $district = District::query()->with(['region', 'country'])->find($district_id);

            $this->form['country_id'] = $district->country_id;
            $this->form['region_id'] = $district->region_id;
        }
        $this->form['city_id'] = 0;
        $this->form['place_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormCityId($city_id)
    {
        if ($city_id) {
            $city = City::query()->with(['district', 'region', 'country'])->find($city_id);

            $this->form['country_id'] = $city->country_id ?: $city->district->country_id ?: $city->region->country_id;
            $this->form['region_id'] = $city->region_id ?: $city->district->region_id;
            $this->form['district_id'] = $city->district_id;

            $address = implode(' ', [$city->region->title, $city->district->title, $city->title]);
        }
        $this->form['place_id'] = 0;

        $this->dispatchBrowserEvent('initLocation', ['address' => $address ?? '']);
    }

    public function updatedFormPlaceId($place_id)
    {
        if ($place_id) {
            $this->place = Place::query()->with(['city', 'district', 'region', 'country'])->find($this->form['place_id']);
            $this->form['country_id'] = $this->place->country_id ?: $this->place->city->country_id ?: $this->place->district->country_id ?: $this->place->region->country_id;
            $this->form['region_id'] = $this->place->region_id ?: $this->city->region_id ?: $this->district->region_id;
            $this->form['district_id'] = $this->place->district_id ?: $this->city->district_id;
            $this->form['city_id'] = $this->place->city_id;
        }
    }

    public function updatedFormLat($lat)
    {
        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedFormLng($lng)
    {
        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updatedSelectedId($id)
    {
//        $this->dispatchBrowserEvent('initLocation', []);
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
        $this->model->type_id = $this->form['type_id'];
        $this->model->place_id = $this->form['place_id'] === 0 ? null : $this->form['place_id'];
        $this->model->title = $this->form['title'];
        $this->model->text = $this->form['text'];
        $this->model->country_id = $this->form['country_id'] === 0 ? null : $this->form['country_id'];
        $this->model->region_id = $this->form['region_id'] === 0 ? null : $this->form['region_id'];
        $this->model->district_id = $this->form['district_id'] === 0 ? null : $this->form['district_id'];
        $this->model->city_id = $this->form['city_id'] === 0 ? null : $this->form['city_id'];
        $this->model->lat = $this->form['lat'];
        $this->model->lng = $this->form['lng'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['place_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['text'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];

        $this->form['country_id'] = 0;
        $this->form['region_id'] = 0;
        $this->form['district_id'] = 0;
        $this->form['city_id'] = 0;
        $this->form['lat'] = 48.736383466532274;
        $this->form['lng'] = 31.460746106250006;

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->place_id > 0 ? TourPlace::TYPE_TEMPLATE : TourPlace::TYPE_CUSTOM) : $this->model->type_id;
        $this->form['place_id'] = $this->model->place_id === null ? 0 : $this->model->place_id;
        $this->place = Place::query()->find($this->form['place_id']);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['text'] = $this->model->getTranslations('text');

        $this->form['region_id'] = $this->model->region_id === null ? 0 : $this->model->region_id;
        $this->form['district_id'] = $this->model->district_id === null ? 0 : $this->model->district_id;
        $this->form['city_id'] = $this->model->city_id === null ? 0 : $this->model->city_id;
        $this->form['lat'] = $this->model->lat;
        $this->form['lng'] = $this->model->lng;

        $this->dispatchBrowserEvent('initLocation', []);

    }

    public function syncLocation(array $location = [
        'country_id' => 0,
        'region_id' => 0,
        'district_id' => 0,
        'city_id' => 0,
        'lat' => 0,
        'lng' => 0,
    ])
    {
        foreach ($location as $key => $value) {
            if (array_key_exists($key, $this->form)) {
                $this->form[$key] = $value;
            }
        }
    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
