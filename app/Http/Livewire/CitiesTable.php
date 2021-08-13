<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Place;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class CitiesTable.
 */
class CitiesTable extends DataTableComponent
{

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

    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {

        $has_place = $this->getFilter('has_place');
        $region_id = $this->getFilter('region_id');

        $query = City::query()->withCount(['places'])
            ->when(!empty($has_place), function (Builder $q) use ($has_place) {
                if ($has_place === 'yes') {
                    return $q->whereHas('places');
                } else {
                    return $q->doesntHave('places');
                }
            })
            ->when($region_id > 0, function (Builder $q) use ($region_id) {
                return $q->where('region_id', $region_id);
            });

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [

            Column::make(__('Country'), 'country_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->country)->title;
                })
                ->sortable(),

            Column::make(__('Title'), 'title')
                ->searchable()
                ->sortable(),

            Column::make(__('Region'), 'region_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->region)->title;
                })
                ->sortable(),

            Column::make(__('Places'), 'places_count')
                ->sortable(),

//            Column::make(__('Url'), 'slug')
//                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.city.includes.actions', ['city' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [

            'has_place' => Filter::make(__('Начеленні пункти'))
                ->select([
                    '' => 'Всі',
                    'yes' => 'З місцями',
                    'no' => 'Без місць',
                ]),
            'region_id' => Filter::make(__('Начеленні пункти'))
                ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray()))
        ];
    }
}
