<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
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


    public array $perPageAccepted = [30, 50, 100];

    public $region;
    public $district;


    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    public function mount($region = null, $district = null): void
    {

        if (!empty($district)) {
            $this->district = $district;
            $this->region = $district->region;
        } elseif (!empty($region)) {
            $this->region = $region;
        }

    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = City::query();

        $has_place = $this->getFilter('has_place');
        $region_id = $this->region ? $this->region->id : $this->getFilter('region_id');
        $district_id = $this->district ? $this->district->id : $this->getFilter('district_id');

        $query = $query->withCount(['places'])->with(['country', 'region', 'district'])
            ->when(!empty($has_place), function (Builder $q) use ($has_place) {
                if ($has_place === 'yes') {
                    return $q->whereHas('places');
                } else {
                    return $q->doesntHave('places');
                }
            })
            ->when($region_id > 0, function (Builder $q) use ($region_id) {
                return $q->where('region_id', $region_id);
            })
            ->when($district_id > 0, function (Builder $q) use ($district_id) {
                return $q->where('district_id', $district_id);
            });

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->sortable(),

            Column::make(__('Country'), 'country_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->country)->title;
                })
                ->sortable(),

            Column::make(__('Region'), 'region_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->region)->title;
                })
                ->sortable(),
            Column::make(__('District'), 'district_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->district)->title;
                })
                ->sortable(),

            Column::make(__('Title'), 'title')
                ->searchable(function (Builder $query, $searchTerm) {
                    return $query->where(function ($sq) use ($searchTerm) {
                        return $sq->where('title->uk', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->ru', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->en', 'LIKE', "%$searchTerm%")
                            ->orWhere('title->pl', 'LIKE', "%$searchTerm%");
                    });
                })
                ->sortable(),

            Column::make(__('Slug'), 'slug')
                ->searchable()
                ->sortable(),

            Column::make(__('Places'), 'places_count')
                ->sortable(),


            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.city.includes.actions', ['city' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        $filters = ['has_place' => Filter::make(__('З місцями'))
            ->select([
                '' => 'Всі',
                'yes' => 'З місцями',
                'no' => 'Без місць',
            ])];

        if (empty($this->region)) {
            $filters['region_id'] = Filter::make(__('Область'))
                ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray()));
        }

        return $filters;
    }
}
