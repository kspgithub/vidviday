<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Accommodation;
use App\Models\Region;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property \App\Models\TourAccommodation $model
 */
class TourAccommodation extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $options = [];

    public $accommodation_id = 0;


    public function rules()
    {
        return [
            'accommodation_id' => ['required', Rule::exists('accommodations', 'id')],
        ];
    }

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->options = Accommodation::toSelectArray();
    }

    public function query()
    {
        return \App\Models\TourAccommodation::query()->where('tour_id', $this->tour->id)->with(['accommodation'])->orderBy('position');
    }

    public function render()
    {
        return view('admin.tour-accommodation.includes.form', ['items' => $this->query()->get()]);
    }

    public function afterModelInit()
    {
        $this->accommodation_id = (int)$this->model->accommodation_id;

    }

    public function beforeSaveItem()
    {
        $this->validate();
        $this->model->tour_id = $this->tour->id;
        $this->model->accommodation_id = (int)$this->accommodation_id;
        $this->model->type_id = 0;
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_accommodations')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }


    public function editRecordClass(): string
    {
        return \App\Models\TourAccommodation::class;
    }
}