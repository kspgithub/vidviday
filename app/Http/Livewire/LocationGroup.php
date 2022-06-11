<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Services\GoogleMapsService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;

class LocationGroup extends Component
{
    public Model $model;

    public bool $useCountry;
    public bool $useRegion;
    public bool $useDistrict;
    public bool $useCity;
    public bool $useCoords;
    public bool $useMap;

    public Collection $countries;
    public Collection $regions;
    public Collection $districts;
    public Collection $cities;

    public Country|null $country = null;
    public Region|null $region = null;
    public District|null $district = null;
    public City|null $city = null;

    public $selectedCountry;
    public $selectedRegion;
    public $selectedDistrict;
    public $city_id;

    public $lat;
    public $lng;

    public string $latName = 'lat';
    public string $lngName = 'lng';

    public function mount(
        Model $model,
              $country_id = null,
              $region_id = null,
              $district_id = null,
              $city_id = null,
              $lat = null,
              $lng = null,
              $map = null,
    ): void
    {
        $this->model = $model;

        $attributes = $model->getFillable();

        $this->useCountry = in_array('country_id', $attributes);
        $this->useRegion = in_array('region_id', $attributes);
        $this->useDistrict = in_array('district_id', $attributes);
        $this->useCity = in_array('city_id', $attributes);
        $this->useCoords = in_array($this->latName, $attributes) && in_array($this->lngName, $attributes);
        $this->useMap = $this->useCoords;

        $this->selectedCountry = $country_id ?: $model->country_id ?? 0;
        $this->country = Country::query()->find($this->selectedCountry);
        $this->selectedRegion = $region_id ?: $model->region_id ?? 0;
        $this->region = Region::query()->with(['country'])->find($this->selectedRegion);
        $this->selectedDistrict = $district_id ?: $model->district_id ?? 0;
        $this->district = District::query()->with(['region', 'country'])->find($this->selectedDistrict);
        $this->city_id = $city_id ?: $model->city_id ?? 0;
        $this->city = City::query()->with(['region', 'country', 'district'])->find($this->city_id);

        $this->lat = $lat ?: $model->lat ?? 48.736383466532274;
        $this->lng = $lng ?: $model->lng ?? 31.460746106250006;

        $this->countries = Country::toSelectBox();
//        $this->regions = $this->selectedCountry ? Region::query()->where('country_id', $this->selectedCountry)->toSelectBox() : collect();
//        $this->districts = $this->selectedRegion ? District::query()->where('region_id', $this->selectedRegion)->toSelectBox() : collect();
//        $this->cities = $this->selectedDistrict ? City::query()->where('district_id', $this->selectedDistrict)->toSelectBox() : collect();

        $this->regions = collect($this->region ? [$this->region->asSelectBox()] : []);
        $this->districts = collect($this->district ? [$this->district->asSelectBox()] : []);
        $this->cities = collect($this->city ? [$this->city->asSelectBox()] : []);
    }

    public function render(): View
    {
        if($this->selectedDistrict) {
            $district = District::query()->find($this->selectedDistrict);
            $this->districts = collect([$district->asSelectBox()]);
        }
        if($this->city_id) {
            $city = City::query()->find($this->city_id);
            $this->cities = collect([$city->asSelectBox()]);
        }
        return view('livewire.location-group');
    }

    public function updatedSelectedCountry($country): void
    {
        $this->selectedCountry = $country ? (int)Arr::first((array)$country) : 0;

        if ($this->selectedCountry) {
            $this->country = Country::query()->find($this->selectedCountry);

//            $this->regions = Region::query()->where('country_id', $country)->toSelectBox();

            if($this->region && $this->region->country->id !== $this->selectedCountry) {
                $this->selectedRegion = 0;
            }

            if($this->district && $this->district->country->id !== $this->selectedCountry) {
                $this->selectedDistrict = 0;
                $this->districts = collect();
            }

            if($this->city && $this->city->country->id !== $this->selectedCountry) {
                $this->city_id = 0;
                $this->cities = collect();
            }
        } else {
            $this->country = null;
            $this->region = null;
            $this->selectedRegion = 0;
            $this->district = null;
            $this->selectedDistrict = 0;
            $this->city = null;
            $this->city_id = 0;
        }

        $this->dispatchBrowserEvent('initLocation', ['data' => 'ok']);

        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }

    public function updatedSelectedRegion($region): void
    {
        $this->selectedRegion = $region ? (int)Arr::first((array)$region) : 0;

        if ($this->selectedRegion) {
            $this->region = Region::query()->with(['country'])->find($this->selectedRegion);

            $this->regions = collect([$this->region->asSelectBox()]);
//            $this->regions = Region::query()->where('country_id', $this->region->country->id)->toSelectBox();
//            $this->districts = District::query()->where('region_id', $this->region->id)->toSelectBox();

            $this->selectedCountry = $this->region->country_id ?? $this->selectedCountry;
            $this->country = $this->region->country;

            if($this->district && $this->district->region_id !== $this->selectedRegion) {
                $this->selectedDistrict = 0;
//                $this->districts = District::query()->where('region_id', $region)->toSelectBox();
            }

            if($this->city && $this->city->region_id !== $this->selectedRegion) {
                $this->city_id = 0;
                $this->cities = collect();
            }
        } else {
            $this->region = null;
            $this->district = null;
            $this->selectedDistrict = 0;
            $this->city = null;
            $this->city_id = 0;
        }

        $this->dispatchBrowserEvent('initLocation', ['data' => 'ok']);

        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }

    public function updatedSelectedDistrict($district): void
    {
        $this->selectedDistrict = $district ? (int)Arr::first((array)$district) : 0;

        if ($this->selectedDistrict) {
            $this->district = District::query()->with(['region', 'country'])->find($this->selectedDistrict);

            $this->districts = collect([$this->district->asSelectBox()]);

            $this->districts = collect([$this->district->asSelectBox()]);
            $this->regions = collect([$this->district->region->asSelectBox()]);
//            $this->cities = City::query()->where('district_id', $this->district->id)->toSelectBox();
//            $this->districts = District::query()->where('region_id', $this->district->region->id)->toSelectBox();
//            $this->regions = Region::query()->where('country_id', $this->district->country->id)->toSelectBox();

            $this->selectedRegion = $this->district->region_id ?? $this->selectedRegion;
            $this->region = $this->district->region;
            $this->selectedCountry = $this->district->country_id ?? $this->selectedCountry;
            $this->country = $this->district->country;

            if($this->city && $this->city->district->id !== $this->selectedDistrict) {
                $this->city_id = 0;
//                $this->cities = City::query()->where('district_id', $district)->toSelectBox();
            }
        } else {
            $this->district = null;
            $this->city = null;
            $this->city_id = 0;
        }

        $this->dispatchBrowserEvent('initLocation', ['data' => 'ok']);

        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }

    public function updatedCityId($city): void
    {
        $this->city_id = $city ? (int)Arr::first((array)$city) : 0;

        if ($this->city_id) {
            $this->city = City::query()->with(['district', 'region', 'country'])->find($this->city_id);

            $this->cities = collect([$this->city->asSelectBox()]);
            $this->districts = collect([$this->city->district->asSelectBox()]);
            $this->regions = collect([$this->city->region->asSelectBox()]);

            $this->selectedDistrict = $this->city->district_id ?? $this->selectedDistrict;
            $this->district = $this->city->district;
            $this->selectedRegion = $this->city->region_id ?? $this->selectedRegion;
            $this->region = $this->city->region;
            $this->selectedCountry = $this->city->country_id ?? $this->selectedCountry;
            $this->country = $this->city->country;

        } else {
            $this->city = null;
        }

        $this->dispatchBrowserEvent('initLocation', ['cityChanged' => true]);

        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }

    public function updatedLat($lat)
    {
        $this->dispatchBrowserEvent('initLocation');
        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }

    public function updatedLng($lng)
    {
        $this->dispatchBrowserEvent('initLocation');
        $this->emit('locationChanged', [
            'country_id' => $this->selectedCountry,
            'region_id' => $this->selectedRegion,
            'district_id' => $this->selectedDistrict,
            'city_id' => $this->city_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ]);
    }
}
