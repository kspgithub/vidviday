<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Transport;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * @property \App\Models\TourTransport $model
 */
class TourTransport extends Component
{
    use EditRecordTrait;

    /**
     * @var Tour
     */
    public $tour;

    public $options = [];

    public $transport_id = 0;

    public $title_uk = '';
    public $title_ru = '';
    public $title_en = '';
    public $title_pl = '';

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->options = Transport::toSelectArray();
    }

    public function rules()
    {
        return [
            'transport_id' => ['required', Rule::exists('transports', 'id')],
            'title_uk' => ['nullable'],
            'title_ru' => ['nullable'],
            'title_en' => ['nullable'],
            'title_pl' => ['nullable'],
        ];
    }

    public function query(): Builder|Relation
    {
        return \App\Models\TourTransport::query()->where('tour_id', $this->tour->id)->with(['transport'])->orderBy('position');
    }

    public function render()
    {
        return view('admin.tour-transport.includes.form', ['items' => $this->query()->get()]);
    }

    public function afterModelInit()
    {
        $this->transport_id = (int)$this->model->transport_id;
        $this->getTranslations('title');

    }

    public function beforeSaveItem()
    {
        $this->validate();
        $this->model->tour_id = $this->tour->id;
        $this->model->transport_id = (int)$this->transport_id;
        $this->setTranslations('title');
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_transports')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function editRecordClass(): string
    {
        return \App\Models\TourTransport::class;
    }
}
