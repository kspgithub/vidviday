<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TourDiscountsTable extends Component
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

        $this->options = Discount::all();
    }

    public function query()
    {
        return $this->tour->discounts();
    }

    public function detachItem($id)
    {
        $this->query()->detach([$id]);
    }

    public function attachItem()
    {
        if ($this->item_id > 0 && $this->query()->where('id', $this->item_id)->count() === 0) {
            $this->query()->attach($this->item_id);
        }
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_discounts')
                ->where([['tour_id', $this->tour->id], ['discount_id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function render()
    {
        return view('admin.tour.includes.tour-discounts', ['items' => $this->query()->get()]);
    }
}
