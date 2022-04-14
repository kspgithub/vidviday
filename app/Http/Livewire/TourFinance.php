<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Finance;
use App\Models\IncludeType;
use App\Models\Tour;
use App\Models\TourInclude;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
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
    public $tourIncludeOptions = [];
    public $tourExcludeOptions = [];

    public $locales = [];

    public $text_uk = '';
    public $text_ru = '';
    public $text_en = '';
    public $text_pl = '';

    public $type_id = 1;
    public $finance_id = 0;

    protected function rules()
    {
        return [
            'type_id' => 'required',
            'finance_id' => 'nullable',
            'text_uk' => 'nullable',
            'text_ru' => 'nullable',
            'text_en' => 'nullable',
            'text_pl' => 'nullable',
        ];
    }

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = IncludeType::query()->whereIn('id', [1, 2])->toSelectBox();
        $this->tourIncludeOptions = Finance::query()->where('type_id', 1)->toSelectBox();
        $this->tourExcludeOptions = Finance::query()->where('type_id', 2)->toSelectBox();
        $this->locales = $this->getLocales();
    }

    public function render()
    {
        return view('admin.tour.includes.tour-finance', ['items' => $this->query()->get()]);
    }

    public function query(): Builder|Relation
    {
        return TourInclude::where('tour_id', $this->tour->id)->with(['type'])->orderBy('type_id');
    }

    public function afterModelInit()
    {
        $this->type_id = $this->model->type_id ?? 1;
        $this->finance_id = $this->model->finance_id;
        $this->getTranslations('text');
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->type_id;
        $this->model->finance_id = (int)$this->finance_id === 0 ? null : $this->finance_id;
        $this->setTranslations('text');
    }

    public function editRecordClass(): string
    {
        return TourInclude::class;
    }

    public function getFinanceOptionsProperty()
    {
        switch ((int)$this->type_id) {
            case 1:
                return $this->tourIncludeOptions;
            case 2:
                return $this->tourExcludeOptions;
            default:
                return collect([]);
        }
    }

    public function getFinanceProperty()
    {
        return Finance::find($this->finance_id);
    }
}
