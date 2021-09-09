<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\IncludeType;
use App\Models\Tour;
use App\Models\TourInclude;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

/**
 * @property TourInclude|null $model
 */
class TourFinance extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $types = [];

    public $locales = [];

    public $title_uk = '';
    public $title_ru = '';
    public $title_en = '';
    public $title_pl = '';

    public $type_id = 1;

    protected $rules = [
        'type_id' => 'required',

        'title_uk' => 'required',
        'title_ru' => 'nullable',
        'title_en' => 'nullable',
        'title_pl' => 'nullable',
    ];

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = IncludeType::toSelectBox();
        $this->locales = $this->getLocales();
    }

    public function render()
    {
        return view('admin.tour.includes.tour-finance', ['items' => $this->query()->get()]);
    }

    public function query(): Builder
    {
        return TourInclude::where('tour_id', $this->tour->id)->with(['type'])->orderBy('type_id');
    }

    public function afterModelInit()
    {
        $this->type_id = $this->model->type_id ?? 1;
        $this->getTranslations('title');
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->type_id;
        $this->setTranslations('title');
    }

    public function editRecordClass(): string
    {
        return TourInclude::class;
    }
}
