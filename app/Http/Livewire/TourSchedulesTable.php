<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class TourSchedulesTable.
 */
class TourSchedulesTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

    /**
     * @var Tour
     */
    public $tour;

    /**
     * @var TourSchedule
     */
    public $schedule = null;

    /**
     * @var Currency[]
     */
    public $currencies = [];

    /**
     * @var string
     */
    public string $defaultSortColumn = 'start_date';

    /**
     * @var string
     */
    public string $defaultSortDirection = 'desc';

    protected $listeners = ['recordSaved'];

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
        $this->currencies = Currency::toSelectBox('iso', 'iso');
        $this->recordSaved();
    }

    public function recordSaved($schedule = null)
    {
        if ($schedule === null) {
            $schedule = new TourSchedule();
            $schedule->tour_id = $this->tour->id;
            $schedule->price = $this->tour->price;
            $schedule->commission = $this->tour->commission;
        }
        $this->schedule = $schedule;
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = TourSchedule::query()->where('tour_id', $this->tour->id);

        return $query;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('admin.tour-schedule.includes.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
            ]);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [

            Column::make(__('Start Date'), 'start_date')
                ->format(function ($value, $column, $row) {
                    return $row->start_date ? $row->start_date->format('d.m.Y') : '-';
                })
                ->sortable(),

            Column::make(__('End Date'), 'end_date')
                ->format(function ($value, $column, $row) {
                    return $row->end_date ? $row->end_date->format('d.m.Y') : '-';
                })
                ->sortable(),

            Column::make(__('Places'), 'places')
                ->sortable(),

            Column::make(__('Price'), 'price')
                ->sortable(),

            Column::make(__('Commission'), 'commission')
                ->sortable(),

            Column::make(__('Currency'), 'currency')
                ->sortable(),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.tour-schedule.includes.publish-switch', ['model' => $row]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour-schedule.includes.actions', ['tour' => $this->tour, 'schedule' => $row]);
                }),
        ];
    }

    public function edit($id)
    {
        $this->schedule = TourSchedule::find($id);
    }

    public function delete($id)
    {
        $schedule = TourSchedule::find($id);
        $schedule->delete();
    }

    public function publish($id, $isPublished)
    {
        $schedule = TourSchedule::find($id);
        $schedule->published = $isPublished ? 1 : 0;
        $schedule->save();
    }
}
