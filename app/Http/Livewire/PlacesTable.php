<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Place;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class PlacesTable extends DataTableComponent
{

    /**
     * @var string
     */
    public string $defaultSortColumn = 'created_at';

    /**
     * @var string
     */
    public string $defaultSortDirection = 'desc';

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
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $region_id = (int)$this->getFilter('region_id');

        $query = Place::query()->withCount('media')
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
                ->searchable()
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

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.place.update', $row)]);
                })
                ->sortable(),

            Column::make(__('Gallery'))
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.media-link', [
                        'url' => route('admin.place.edit', $row),
                        'count' => $row->media_count,
                    ]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.place.includes.actions', ['place' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'region_id' => Filter::make(__('Regions'))
                ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray())),
            'district_id' => Filter::make(__('Districts'))
                ->select(array_merge([0 => 'Всі'], District::toSelectArray())),
        ];


    }
}
