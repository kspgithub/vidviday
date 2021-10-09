<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TourPlaces extends Component
{
    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var array|Collection
     */
    public $regions = [];

    /**
     * @var array|Collection
     */
    public $districts = [];

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
    public $item_id = 0;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;

        $this->regions = Region::query()->orderBy('title')->get();
        $this->districts = District::query()->orderBy('title')->get();
    }

    public function detachItem($id)
    {
        $this->query()->detach([$id]);
    }

    public function query()
    {
        return $this->tour->places()->with(['region', 'district', 'city']);
    }

    public function attachItem()
    {
        if ($this->item_id > 0 && $this->query()->where('id', $this->item_id)->count() === 0) {
            $this->query()->attach($this->item_id, ['position' => $this->query()->count() + 1]);
        }
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_places')
                ->where([['tour_id', $this->tour->id], ['place_id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function render()
    {
        return view('admin.tour.includes.tour-places', ['items' => $this->query()->get()]);
    }


    public function getFilteredDistrictsProperty()
    {
        if ((int)$this->region_id > 0) {
            return $this->districts->where('region_id', (int)$this->region_id)->all();
        }
        return [];
    }
}
