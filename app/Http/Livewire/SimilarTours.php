<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use Livewire\Component;

class SimilarTours extends Component
{
    /**
     * @var Tour
     */
    public $tour;

    public $tourId = 0;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
    }

    public function query()
    {
        return Tour::query()->whereIn('id', $this->tour->similar ?? []);
    }

    public function render()
    {
        return view('admin.tour.includes.similar-tours', ['items' => $this->tour->getSimilarTours(0)]);
    }


    public function updateOrder($items)
    {
        $order = [];
        foreach ($items as $item) {
            $order[] = (int)$item['value'];
        }
        $this->tour->similar = $order;
        $this->tour->save();
    }

    public function detachItem($id)
    {
        $items = $this->tour->similar ?? [];
        if (in_array((int)$id, $items)) {
            $items = array_diff($items, [(int)$id]);
            $this->tour->similar = array_filter($items);
            $this->tour->save();
        }
    }

    public function attachItem()
    {
        $items = $this->tour->similar ?? [];
        if (!in_array((int)$this->tourId, $items)) {
            $items[] = (int)$this->tourId;
            $this->tour->similar = array_filter($items);
            $this->tour->save();
        }

        $this->tourId = 0;
    }
}
