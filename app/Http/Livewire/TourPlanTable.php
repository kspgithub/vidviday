<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Tour;
use App\Models\TourPlan;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

/**
 * @property TourPlan|null $model
 */
class TourPlanTable extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $locales = [];

    public $day = 1;



    /**
    public $title_uk = '';
    public $title_ru = '';
    public $title_en = '';
    public $title_pl = '';
     */


    public $text_uk = '';
    public $text_ru = '';
    public $text_en = '';
    public $text_pl = '';


    protected $rules = [
        //'title_uk' => 'required',
        //'title_ru' => 'nullable',
        //'title_en' => 'nullable',
        //'title_pl' => 'nullable',

        'text_uk' => 'required',
        'text_ru' => 'nullable',
        'text_en' => 'nullable',
        'text_pl' => 'nullable',
    ];

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->locales = $this->getLocales();
    }


    public function render()
    {
        return view('admin.tour.includes.tour-plan', [
            'items' => $this->query()->get(),
            "countTourPlan" => $this->existTourPlan()
        ]);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = TourPlan::query()->where('tour_id', $this->tour->id);

        return $query;
    }

    public function afterModelInit()
    {
        //$this->getTranslations('title');
        $this->getTranslations('text');
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        //$this->setTranslations('title');
        $this->setTranslations('text');
    }


    public function editRecordClass(): string
    {
        return TourPlan::class;
    }

    public function existTourPlan()
    {
        return $this->query()->count();
    }
}
