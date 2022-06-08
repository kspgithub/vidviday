<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
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

    public $options = [];

    public $place_ids = [];

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

    public function query(): Builder|Relation
    {
        return $this->tour->tourPlaces()->with(['place']);
    }

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->regions = Region::query()->orderBy('title')->get();
        $this->districts = District::query()->orderBy('title')->get();
        $this->place_ids = $tour->tourPlaces()->pluck('id')->toArray();
        $this->options = [];
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_places')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function detachItem($id)
    {
        $this->query()->detach([$id]);
    }

    public function attachItem()
    {
        if ($this->item_id > 0 && $this->query()->where('id', $this->item_id)->count() === 0) {
            $this->query()->attach($this->item_id, ['position' => $this->query()->count() + 1]);
            $this->item_id = 0;
        }
    }

    public function render()
    {
        return view('admin.tour.includes.tour-places', [
            'items' => $this->query()->orderBy('position')->get()
        ]);
    }

}
