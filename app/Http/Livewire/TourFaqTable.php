<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourFaq;
use App\Models\TourQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * @property TourFaq $model
 */
class TourFaqTable extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $question = [];

    public $answer = [];


    protected $rules = [
        'question.*' => ['required'],
        'answer.*' => ['required'],
    ];

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
    }

    public function render()
    {
        return view('admin.tour.includes.tour-faq', ['items' => $this->query()->get()]);
    }

    public function editRecordClass(): string
    {
        return TourFaq::class;
    }


    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_faqs')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function beforeSaveItem()
    {
        if (!$this->model) {
            $this->model = new TourFaq();
        }
        $this->model->tour_id = $this->tour->id;
        $this->model->question = $this->question;
        $this->model->answer = $this->answer;
    }

    public function afterModelInit()
    {
        foreach (siteLocales() as $lang) {
            $this->question[$lang] = $this->model->getTranslation('question', $lang) ?? '';
            $this->answer[$lang] = $this->model->getTranslation('answer', $lang) ?? '';
        }
    }

    public function query(): Builder|Relation
    {
        return $this->tour->faq()->orderBy('position');
    }
}
