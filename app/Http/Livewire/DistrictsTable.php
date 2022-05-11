<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Models\Place;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class CitiesTable.
 */
class DistrictsTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

    public array $perPageAccepted = [30, 50, 100];

    public $region;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];

    public function mount($region = null): void
    {
        $this->region = $region;
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {

        $region_id = !empty($this->region) ? $this->region->id : $this->getFilter('region_id');

        $query = District::query()->with(['country', 'region'])
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

//            Column::make(__('Slug'), 'slug')
//                ->searchable()
//                ->sortable(),

            Column::make(__('Links'))
                ->format(function ($value, $column, $row) {
                    return view('admin.district.includes.links', ['district' => $row]);
                }),
            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.district.includes.actions', ['district' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        if (empty($this->region)) {
            return [
                'region_id' => Filter::make(__('Область'))
                    ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray()))
            ];
        }
        return [];
    }
}
