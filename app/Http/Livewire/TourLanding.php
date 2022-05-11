<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\LandingPlace;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property \App\Models\TourLanding $model
 */
class TourLanding extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $options = [];

    public $landing_id = 0;

    public $title_uk = '';
    public $title_ru = '';
    public $title_en = '';
    public $title_pl = '';


    public function rules()
    {
        return [
            'landing_id' => ['required', Rule::exists('landing_places', 'id')],
            'title_uk' => ['nullable'],
            'title_ru' => ['nullable'],
            'title_en' => ['nullable'],
            'title_pl' => ['nullable'],
        ];
    }

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->options = LandingPlace::toSelectArray();
    }

    public function query(): Builder|Relation
    {
        return \App\Models\TourLanding::query()->where('tour_id', $this->tour->id)->with(['landing'])->orderBy('position');
    }

    public function render()
    {
        return view('admin.tour-landing.includes.form', ['items' => $this->query()->get()]);
    }

    public function afterModelInit()
    {
        $this->landing_id = (int)$this->model->landing_id;
        $this->getTranslations('title');

    }

    public function beforeSaveItem()
    {
        $this->validate();
        $this->model->tour_id = $this->tour->id;
        $this->model->landing_id = (int)$this->landing_id;
        $this->setTranslations('title');
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_landings')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }


    public function editRecordClass(): string
    {
        return \App\Models\TourLanding::class;
    }
}
