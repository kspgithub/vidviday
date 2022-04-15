<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Livewire\Component;

class LocationGroup extends Component
{
    public $countries;
    public $regions;
    public $districts;
    public $cities;

    public $selectedCountry = null;
    public $selectedRegion = null;
    public $selectedDistrict = null;
    public $selectedCity = null;

    public function mount($model): void
    {
        $this->selectedCountry = $model->country_id ?? null;
        $this->selectedRegion = $model->region_id ?? null;
        $this->selectedDistrict = $model->district_id ?? null;
        $this->selectedCity = $model->city_id ?? null;

        $this->countries = Country::toSelectBox()->all();
        $this->regions = $this->selectedCountry ? Region::query()->where('country_id', $this->selectedCountry)->toSelectBox()->all() : collect();
        $this->districts = $this->selectedRegion ? District::query()->where('region_id', $this->selectedRegion)->toSelectBox()->all() : collect();
        $this->cities = $this->selectedDistrict ? City::query()->where('district_id', $this->selectedDistrict)->toSelectBox()->all() : collect();

    }

    public function render()
    {
        return view('livewire.location-group');
    }

    public function updatedSelectedCountry($country)
    {
        $this->selectedCountry = !is_null($country) ? (int) Arr::first((array) $country) : null;

        if(!is_null($this->selectedCountry)) {
            $this->regions = Region::query()->where('country_id', $country)->toSelectBox()->all();
            $this->selectedRegion = null;
            $this->selectedDistrict = null;
            $this->selectedCity = null;
            $this->districts = collect();
            $this->cities = collect();
        }
    }

    public function updatedSelectedRegion($region)
    {
        $this->selectedRegion = !is_null($region) ? (int) Arr::first((array) $region) : null;

        if(!is_null($this->selectedRegion)) {
            $this->districts = District::query()->where('region_id', $region)->toSelectBox()->all();
            $this->selectedDistrict = null;
            $this->selectedCity = null;
            $this->cities = collect();
        }
    }

    public function updatedSelectedDistrict($district)
    {
        $this->selectedDistrict = !is_null($district) ? (int) Arr::first((array) $district) : null;

        if(!is_null($this->selectedDistrict)) {
            $this->cities = City::query()->where('district_id', $district)->toSelectBox()->all();
            $this->selectedCity = null;
        }
    }

    public function updatedSelectedCity($city)
    {
        $this->selectedCity = !is_null($city) ? (int) Arr::first((array) $city) : null;
    }
}
