<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Region;
use App\Models\Transport;
use App\Models\Tour;
use App\Models\TourTransport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TourTransports extends Component
{
    use EditRecordTrait;

    protected $listeners = [
        'updateType' => 'syncType',
    ];

    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var Collection
     */
    public $types;

    /**
     * @var Collection
     */
    public $transports;


    public array $form = [
        'type_id' => null,
        'transport_id' => 0,
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'text' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
    ];

    /**
     * @var Transport
     */
    public $transport;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourTransport::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourTransport::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->transports = Transport::query()->orderBy('title')->toSelectBox();
        $this->transport = null;
    }

    public function editRecordClass(): string
    {
        return TourTransport::class;
    }

    public function query(): Builder|Relation
    {
        return $this->tour->tourTransports()->with(['transport']);
    }

    protected function rules()
    {
        $rules = [
            'form.type_id' => 'required',
            'form.transport_id' => Rule::when(fn() => $this->form['type_id'] == TourTransport::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourTransport::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        return view('admin.tour.transport.livewire', [
            'items' => $this->tour->groupTourTransport
        ]);
    }

    public function updatedFormTypeId($type_id)
    {
        if($type_id == TourTransport::TYPE_CUSTOM) {
            $this->form['transport_id'] = 0;
        }

        if(!$this->type) {
            $this->type = $type_id;

            $this->form['transport_id'] = 0;

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updatedFormTransportId($transport_id)
    {
        if ($transport_id) {
            $this->transport = Transport::query()->find($this->form['transport_id']);
        }
    }

    public function updatedSelectedId($id)
    {
//        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tour_transports')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->transport_id = $this->form['transport_id'] === 0 ? null : $this->form['transport_id'];
        $this->model->title = $this->form['title'];
        $this->model->text = $this->form['text'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['transport_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['text'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->transport_id > 0 ? TourTransport::TYPE_TEMPLATE : TourTransport::TYPE_CUSTOM) : $this->model->type_id;
        $this->type = $this->model->type_id;
        $this->form['transport_id'] = $this->model->transport_id === null ? 0 : $this->model->transport_id;
        $this->transport = Transport::query()->find($this->form['transport_id']);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['text'] = $this->model->getTranslations('text');

        $this->dispatchBrowserEvent('initLocation', []);

    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
