<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\Tour;
use App\Models\TourQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TourUserQuestions extends DataTableComponent
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

    /**
     * @var Tour
     */
    public $tour;


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


    public function mount(Tour $tour)
    {
        $this->tour = $tour;
        $this->name = current_user()->name;
        $this->email = current_user()->email;
        TourQuestion::fixTree();
    }

    public function query(): Builder|Relation
    {
        $status = $this->getFilter('status');

        return $this->tour->questions()
            ->when(!is_null($status) && $status !== '', function ($query) use ($status) {
                return $query->where('status', $status);
            });
    }


    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('PID'), 'parent_id'),

            Column::make(__('User'), 'name')
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->name . '<br>' . $row->email . '<br>' . $row->phone;
                })
                ->asHtml(),

            Column::make(__('Text'), 'text')
                ->format(function ($value, $column, $row) {
                    return nl2br($row->text);
                })
                ->asHtml(),

            Column::make(__('Rating'), 'rating'),


            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at->format('d.m.Y H:s') : '-';
                }),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.questions-status', ['tour' => $this->tour, 'model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.questions-actions', ['tour' => $this->tour, 'model' => $row]);
                }),
        ];
    }

    public function publishItem($id)
    {
        $item = $this->tour->questions()->find($id);
        if ($item) {
            $item->status = TourQuestion::STATUS_PUBLISHED;
            $item->save();
        }
    }

    public function blockItem($id)
    {
        $item = $this->tour->questions()->find($id);
        if ($item) {
            $item->status = TourQuestion::STATUS_BLOCKED;
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

        $this->validate();
        $item = new TourQuestion();
        $item->tour_id = $this->tour->id;
        $item->name = $this->name;
        $item->email = $this->email;
        $item->text = $this->text;
        $item->parent_id = $this->parent_id;
        $item->avatar = current_user()->avatar;
        $item->save();

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
                'rows' => $this->rows ?? collect(),
                'modalsView' => $this->modalsView(),
            ]);
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make(__('Status'))
                ->select([
                    '' => __('Any'),
                    0 => __('New'),
                    1 => __('Published'),
                    2 => __('Blocked'),
                ]),
        ];
    }
}
