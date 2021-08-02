<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class TourSchedulesTable.
 */
class TourSchedulesTable extends DataTableComponent
{

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

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = TourSchedule::query()->where('tour_id', $this->tour->id);

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [

            Column::make(__('Start Date'), 'start_date')
                ->sortable(),

            Column::make(__('End Date'), 'end_date')
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
                    return view('admin.tour-schedule.includes.actions', ['tour'=>$this->tour, 'schedule' => $row]);
                }),
        ];
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


    public function recordSaved($schedule = null)
    {
        if ($schedule === null) {
            $schedule = new TourSchedule();
            $schedule->tour_id = $this->tour->id;
            $schedule->price = $this->tour->price;
        }
        $this->schedule = $schedule;
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
