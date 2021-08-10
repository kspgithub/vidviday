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
        $query = City::query();

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

            Column::make(__('Place'), 'place_id')
                 ->format(function ($value, $column, $row) {
                     return optional($row->place)->title;
                 })
                 ->sortable(),
            Column::make(__('Url'), 'slug')
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.city.includes.actions', ['city' => $row]);
                }),
        ];
    }
    public function filters(): array
    {
        return [

            (__('City')) => Filter::make(__('Начеленні пункти'))
                ->select([
                    '' => '',
                    'yes' => 'З місцями',
                    'no' => 'Без місць',
                ])
        ];
    }


}
