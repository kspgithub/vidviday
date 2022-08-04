<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserSubscriptionsTable extends DataTableComponent
{
    use DeleteRecordTrait;

    public array $bulkActions = [
    ];

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];


    public $parent_id = 0;


    public $edit = false;


    public $name = '';

    public $email = '';

    public $text = '';


    protected $rules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'text' => ['required'],
    ];


    public function mount()
    {
        $this->name = current_user()->name;
        $this->email = current_user()->email;
    }

    public function query(): Builder|Relation
    {
        $type = $this->getFilter('type');

        return UserSubscription::query()
            ->when(!is_null($type) && $type !== '', function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderBy('created_at', 'desc');
    }


    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('User'), 'name')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->name . '<br>' . $row->email . '<br>' . $row->phone;
                })
                ->asHtml(),

            Column::make(__('Time'), 'call_date')
                ->format(function ($value, $column, $row) {
                    return Carbon::parse($row->call_date)->format('d.m.Y') . ' ' . $row->call_time;
                })
                ->asHtml(),

            Column::make(__('Comment'), 'comment')
                ->format(function ($value, $column, $row) {
                    return nl2br($row->comment);
                })
                ->asHtml(),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at->format('d.m.Y H:s') : '-';
                }),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.subscriptions-status', ['model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.testimonial.includes.subscriptions-actions', ['model' => $row]);
                }),
        ];
    }

    public function publishItem($id)
    {
        $item = UserSubscription::query()->find($id);
        if ($item) {
            $item->status = UserSubscription::STATUS_ACTIVE;
            $item->save();
        }
    }

    public function blockItem($id)
    {
        $item = UserSubscription::query()->find($id);
        if ($item) {
            $item->status = UserSubscription::STATUS_INACTIVE;
            $item->save();
        }
    }

    public function createItem($parent_id)
    {
        $this->parent_id = $parent_id;
        $this->edit = true;
    }

    public function saveItem()
    {

        $model = UserSubscription::query()->find($this->parent_id);
        if ($model) {
            $this->validate();
            $item = new UserSubscription();
            $item->name = $this->name;
            $item->email = $this->email;
            $item->text = $this->text;
            $item->save();
        }


        $this->parent_id = 0;
        $this->text = '';
        $this->edit = false;
    }

    public function cancelEdit()
    {
        $this->parent_id = 0;
        $this->text = '';
        $this->edit = false;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        if ($this->edit) {
            return view('admin.tour.includes.question-form');
        }

        return view('livewire-tables::' . config('livewire-tables.theme') . '.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
            ]);
    }

    public function filters(): array
    {
        return [

        ];
    }
}
