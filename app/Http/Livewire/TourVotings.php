<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourQuestion;
use App\Models\TourVoting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class TourVotings extends DataTableComponent
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

    public function mount(Tour $tour)
    {
        $this->tour = $tour;
    }

    public function query(): Builder|Relation
    {
        $status = $this->getFilter('status');

        return $this->tour->votings()
            ->when(!is_null($status) && $status !== '', function ($query) use ($status) {
                return $query->where('status', $status);
            })->orderBy('created_at', 'desc');
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

            Column::make(__('IP'), 'ip'),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at?->format('d.m.Y H:s') : '-';
                }),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.votings-status', ['tour' => $this->tour, 'model' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour.includes.votings-actions', ['tour' => $this->tour, 'model' => $row]);
                }),
        ];
    }

    public function publishItem($id)
    {
        $item = $this->tour->votings()->find($id);
        if ($item) {
            $item->status = TourVoting::STATUS_PUBLISHED;
            $item->save();
        }
    }

    public function blockItem($id)
    {
        $item = $this->tour->votings()->find($id);
        if ($item) {
            $item->status = TourVoting::STATUS_BLOCKED;
            $item->save();
        }
    }

    /**
     * @return mixed
     */
    public function render()
    {
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
