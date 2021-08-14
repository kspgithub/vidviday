<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use App\Models\TourPlan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class TourPlansTable extends DataTableComponent
{

    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    public function mount(Tour $tour): void
    {
        $this->tour = $tour;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = TourPlan::query()->where('tour_id', $this->tour->id);

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->searchable()
                ->sortable(),

            Column::make(__('Title'), 'title')
                ->searchable()
                ->sortable(),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.place.update', $row)]);
                })
                ->sortable(),


            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour-plan.includes.actions', ['tourPlan' => $row]);
                }),
        ];
    }
}
