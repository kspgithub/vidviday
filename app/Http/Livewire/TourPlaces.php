<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Models\Tour;
use App\Models\TourPlace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
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
    public $regions;

    /**
     * @var Collection
     */
    public $districts;

    /**
     * @var Collection
     */
    public $places;


    /**
     * @var int
     */
    public $type_id = 0;

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
    public $place_id = 0;

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
        $this->regions = Region::query()->orderBy('title')->toSelectBox();
        $this->districts = collect();
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

    public function render()
    {
        if($this->district_id) {
            $district = District::query()->find($this->district_id);
            $this->districts = collect([$district->asSelectBox()]);
        }
        if($this->place_id) {
            $place = Place::query()->find($this->place_id);
            $this->places = collect([$place->asSelectBox()]);
        }

        return view('admin.tour.places.livewire', [
            'items' => $this->query()->orderBy('position')->get()
        ]);
    }

    public function updatedRegionId($region_id)
    {
        $this->district_id = 0;
        $this->place_id = 0;
    }

    public function updatedDistrictId($district_id)
    {
        if($district_id) {
            $district = District::query()->find($district_id);
            $this->region_id = $district->region_id;
        }
        $this->place_id = 0;
    }

    public function updatedPlaceId($place_id)
    {
        if($place_id) {
            $this->place = Place::query()->find($this->place_id);
            $this->region_id = $this->place->region_id;
            $this->district_id = $this->place->district_id;
        }
    }
}
