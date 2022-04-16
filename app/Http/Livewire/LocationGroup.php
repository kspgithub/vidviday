<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
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

    public int|array $selectedCountry;
    public int|array $selectedRegion;
    public int|array $selectedDistrict;
    public int|array $selectedCity;

    public float $lat;
    public float $lng;

    public string $latName = 'lat';
    public string $lngName = 'lng';

    public function mount(
        Model $model,
              $country = true,
              $region = true,
              $district = true,
              $city = true,
              $coords = true,
              $map = true,
    ): void
    {
        $this->model = $model;

        $attributes = $model->getFillable();

        $this->useCountry = in_array('country_id', $attributes) && $country;
        $this->useRegion = in_array('region_id', $attributes) && $region;
        $this->useDistrict = in_array('district_id', $attributes) && $district;
        $this->useCity = in_array('city_id', $attributes) && $city;
        $this->useCoords = in_array($this->latName, $attributes) && in_array($this->lngName, $attributes);
        $this->useMap = $this->useCoords && $map;

        $this->selectedCountry = $model->country_id ?? 0;
        $this->selectedRegion = $model->region_id ?? 0;
        $this->selectedDistrict = $model->district_id ?? 0;
        $this->selectedCity = $model->city_id ?? 0;

        $this->lat = $model->lat ?? 48.736383466532274;
        $this->lng = $model->lng ?? 31.460746106250006;

        $this->countries = Country::toSelectBox();
        $this->regions = $this->selectedCountry ? Region::query()->where('country_id', $this->selectedCountry)->toSelectBox() : collect();
        $this->districts = $this->selectedRegion ? District::query()->where('region_id', $this->selectedRegion)->toSelectBox() : collect();
        $this->cities = $this->selectedDistrict ? City::query()->where('district_id', $this->selectedDistrict)->toSelectBox() : collect();
    }

    public function render(): View
    {
        return view('livewire.location-group');
    }

    public function updatedSelectedCountry($country): void
    {
        $this->selectedCountry = $country ? (int)Arr::first((array)$country) : 0;

        if ($this->selectedCountry) {
            $this->regions = Region::query()->where('country_id', $country)->toSelectBox();
            $this->selectedRegion = 0;
            $this->selectedDistrict = 0;
            $this->selectedCity = 0;
            $this->districts = collect();
            $this->cities = collect();
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedRegion($region): void
    {
        $this->selectedRegion = $region ? (int)Arr::first((array)$region) : 0;

        if ($this->selectedRegion) {
            $this->districts = District::query()->where('region_id', $region)->toSelectBox();
            $this->selectedDistrict = 0;
            $this->selectedCity = 0;
            $this->cities = collect();
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedDistrict($district): void
    {
        $this->selectedDistrict = $district ? (int)Arr::first((array)$district) : 0;

        if ($this->selectedDistrict) {
            $this->cities = City::query()->where('district_id', $district)->toSelectBox();
            $this->selectedCity = 0;
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedCity($city): void
    {
        $this->selectedCity = $city ? (int)Arr::first((array)$city) : 0;

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }
}
