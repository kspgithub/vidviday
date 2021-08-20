<?php

namespace App\Http\Livewire;

use App\Models\Place;
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
     * @var array
     */
    public $options = [];

    /**
     * @var int
     */
    public $item_id = 0;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;

        $this->options = Place::with(['region', 'city'])->orderBy('region_id')->orderBy('title')->get();
    }

    public function detachItem($id)
    {
        $this->query()->detach([$id]);
    }

    public function query()
    {
        return $this->tour->places()->with(['region', 'city']);
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
}
