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

            if($this->region && $this->region->country->id !== $this->selectedCountry) {
                $this->selectedRegion = 0;
            }

            if($this->district && $this->district->country->id !== $this->selectedCountry) {
                $this->selectedDistrict = 0;
                $this->districts = collect();
            }

            if($this->city && $this->city->country->id !== $this->selectedCountry) {
                $this->selectedCity = 0;
                $this->cities = collect();
            }
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedRegion($region): void
    {
        $this->selectedRegion = $region ? (int)Arr::first((array)$region) : 0;

        if ($this->selectedRegion) {
            $this->region = Region::query()->with(['country'])->find($this->selectedRegion);

            $this->regions = Region::query()->where('country_id', $this->region->country->id)->toSelectBox();
            $this->districts = District::query()->where('region_id', $this->region->id)->toSelectBox();

            $this->selectedCountry = $this->city->country->id ?? $this->selectedCountry;

            if($this->district && $this->district->region->id !== $this->selectedRegion) {
                $this->selectedDistrict = 0;
                $this->districts = District::query()->where('region_id', $region)->toSelectBox();
            }

            if($this->city && $this->city->region->id !== $this->selectedRegion) {
                $this->selectedCity = 0;
                $this->cities = collect();
            }
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedDistrict($district): void
    {
        $this->selectedDistrict = $district ? (int)Arr::first((array)$district) : 0;

        if ($this->selectedDistrict) {
            $this->district = District::query()->with(['region', 'country'])->find($this->selectedDistrict);

            $this->cities = City::query()->where('district_id', $this->district->id)->toSelectBox();
            $this->districts = District::query()->where('region_id', $this->district->region->id)->toSelectBox();
            $this->regions = Region::query()->where('country_id', $this->district->country->id)->toSelectBox();

            $this->selectedRegion = $this->city->region->id ?? $this->selectedRegion;
            $this->selectedCountry = $this->city->country->id ?? $this->selectedCountry;

            if($this->city && $this->city->district->id !== $this->selectedDistrict) {
                $this->selectedCity = 0;
                $this->cities = City::query()->where('district_id', $district)->toSelectBox();
            }
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok']);
    }

    public function updatedSelectedCity($city): void
    {
        $this->selectedCity = $city ? (int)Arr::first((array)$city) : 0;

        if ($this->selectedCity) {
            $this->city = City::query()->with(['district', 'region', 'country'])->find($this->selectedCity);

            $this->cities = City::query()->where('district_id', $this->city->district->id)->toSelectBox();
            $this->districts = District::query()->where('region_id', $this->city->region->id)->toSelectBox();
            $this->regions = Region::query()->where('country_id', $this->city->country->id)->toSelectBox();

            $this->selectedDistrict = $this->city->district->id ?? $this->selectedDistrict;
            $this->selectedRegion = $this->city->region->id ?? $this->selectedRegion;
            $this->selectedCountry = $this->city->country->id ?? $this->selectedCountry;

            $address = implode(' ', [$this->city->region->title, $this->city->district->title, $this->city->title]);
        }

        $this->dispatchBrowserEvent('livewire-refresh', ['data' => 'ok', 'address' => $address ?? '']);
    }
}
