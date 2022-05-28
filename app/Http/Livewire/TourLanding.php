<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\LandingPlace;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

/**
 * @property \App\Models\TourLanding|null $model
 */
class TourLanding extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $options = [];

    public $locales = [];

    public $text_uk = '';
    public $text_ru = '';
    public $text_en = '';
    public $text_pl = '';

    public $landing_id = 0;

    protected function rules()
    {
        return [
            'landing_id' => 'nullable',
            'text_uk' => 'nullable',
            'text_ru' => 'nullable',
            'text_en' => 'nullable',
            'text_pl' => 'nullable',
        ];
    }

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->options = LandingPlace::query()->toSelectBox();
        $this->locales = $this->getLocales();
    }

    public function render()
    {
        return view('admin.tour.includes.tour-landing', ['items' => $this->tour->landings()->with('landing')->get()]);
    }

    public function query(): Builder|Relation
    {
        return \App\Models\TourLanding::where('tour_id', $this->tour->id)->with(['landing']);
    }

    public function afterModelInit()
    {
        $this->landing_id = (int)$this->model->landing_id;
        $this->getTranslations('text');
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->landing_id = $this->landing_id === 0 ? null : $this->landing_id;
        $this->setTranslations('text');
    }

    public function editRecordClass(): string
    {
        return \App\Models\TourLanding::class;
    }

    public function getLandingProperty()
    {
        return LandingPlace::find($this->landing_id);
    }
}
