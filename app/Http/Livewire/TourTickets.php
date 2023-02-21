<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\EditRecordTrait;
use App\Models\Region;
use App\Models\Ticket;
use App\Models\Tour;
use App\Models\TourTicket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TourTickets extends Component
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
    public $regions;

    /**
     * @var Collection
     */
    public $tickets;


    public array $form = [
        'type_id' => null,
        'ticket_id' => 0,
        'region_id' => 0,
        'title' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
        'text' => ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''],
    ];

    /**
     * @var Ticket
     */
    public $ticket;

    public $type;

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
        $this->types = collect([
            ['value' => TourTicket::TYPE_TEMPLATE, 'text' => __('Вибрати з шаблону')],
            ['value' => TourTicket::TYPE_CUSTOM, 'text' => __('Свій тип')],
        ]);
        $this->regions = Region::query()->orderBy('title')->toSelectBox();
        $this->tickets = collect();
        $this->ticket = null;
    }

    public function editRecordClass(): string
    {
        return TourTicket::class;
    }

    public function query(): Builder|Relation
    {
        return $this->tour->tourTickets()->with(['ticket']);
    }

    protected function rules()
    {
        $rules = [
            'form.type_id' => 'required',
            'form.ticket_id' => Rule::when(fn() => $this->form['type_id'] == TourTicket::TYPE_TEMPLATE, ['required', 'int', 'min:1']),
        ];

        $locales = $this->tour->locales;

        foreach ($locales as $locale) {
            $rules['form.title.' . $locale] = Rule::when(fn() => $this->form['type_id'] == TourTicket::TYPE_CUSTOM, ['required', 'string']);
        }

        return $rules;
    }

    public function render()
    {
        if ($this->form['region_id']) {
            $region = Region::query()->find($this->form['region_id']);
            $this->regions = collect([$region->asSelectBox()]);
        }
        if ($this->form['ticket_id']) {
            $ticket = Ticket::query()->find($this->form['ticket_id']);
            $this->tickets = collect([$ticket->asSelectBox()]);
        }

        return view('admin.tour.ticket.livewire', [
            'items' => $this->tour->groupTourTickets
        ]);
    }

    public function updatedFormTypeId($type_id)
    {
        if($type_id == TourTicket::TYPE_CUSTOM) {
            $this->form['ticket_id'] = 0;
        }

        if(!$this->type) {
            $this->type = $type_id;

            $this->form['region_id'] = 0;
            $this->form['ticket_id'] = 0;

            $this->updatedFormRegionId($this->form['region_id']);

            $this->dispatchBrowserEvent('initLocation', ['type_id' => $type_id]);
        } else {
            $this->form['type_id'] = 0;
            $this->dispatchBrowserEvent('updateType', ['type_id' => $type_id]);
        }
    }

    public function updatedFormRegionId($region_id)
    {

    }

    public function updatedFormTicketId($ticket_id)
    {
        if ($ticket_id) {
            $this->ticket = Ticket::query()->find($this->form['ticket_id']);
            $this->form['region_id'] = $this->ticket->region_id ;
        }
    }

    public function updatedSelectedId($id)
    {
//        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            DB::table('tours_tickets')
                ->where([['tour_id', $this->tour->id], ['id', $item['value']]])
                ->update(['position' => $item['order']]);
        }
    }

    public function updateActiveTabs($tab)
    {
        $active_tabs = $this->tour->active_tabs;

        $index = array_search($tab, $active_tabs);

        if($index !== false) {
            array_splice($active_tabs, $index);
        } else {
            $active_tabs[] = $tab;
        }

        $this->tour->active_tabs = $active_tabs;
        $this->tour->save();

        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Updated']);
    }

    public function beforeSaveItem()
    {
        $this->model->tour_id = $this->tour->id;
        $this->model->type_id = $this->form['type_id'];
        $this->model->ticket_id = $this->form['ticket_id'] === 0 ? null : $this->form['ticket_id'];
        $this->model->title = $this->form['title'];
        $this->model->text = $this->form['text'];
        $this->model->region_id = $this->form['region_id'] === 0 ? null : $this->form['region_id'];
    }

    public function afterSaveItem()
    {
        $this->form['type_id'] = 0;
        $this->form['ticket_id'] = 0;
        $this->form['title'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['text'] = ['uk' => '', 'ru' => '', 'en' => '', 'pl' => ''];
        $this->form['region_id'] = 0;

        $this->tour->unsetRelations();

        $this->dispatchBrowserEvent('initLocation', []);
    }

    public function afterModelInit()
    {
        $this->form['type_id'] = $this->model->type_id === 0 ? ($this->model->ticket_id > 0 ? TourTicket::TYPE_TEMPLATE : TourTicket::TYPE_CUSTOM) : $this->model->type_id;
        $this->type = $this->model->type_id;
        $this->form['ticket_id'] = $this->model->ticket_id === null ? 0 : $this->model->ticket_id;
        $this->ticket = Ticket::query()->find($this->form['ticket_id']);
        $this->form['title'] = $this->model->getTranslations('title');
        $this->form['text'] = $this->model->getTranslations('text');
        $this->form['region_id'] = $this->model->region_id === null ? 0 : $this->model->region_id;

        $this->dispatchBrowserEvent('initLocation', []);

    }

    public function syncType($type_id)
    {
        $this->type = 0;
        $this->form['type_id'] = $type_id;
        $this->updatedFormTypeId($type_id);
    }
}
