<?php

namespace App\Http\Livewire;

use App\Models\Country;
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
    public array $bulkActions = [];

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
        $country_id = (int) $this->getFilter('country_id');
        $region_id = (int) $this->getFilter('region_id');
        $district_id = (int) $this->getFilter('district_id');

        $query = Place::query()->withCount('media')
            ->when($country_id > 0, function (Builder $q) use ($country_id) {
                return $q->where('country_id', $country_id);
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

            Column::make(__('Title'), 'title')
                ->searchable(function (Builder $query, $searchTerm) {
                    return $query->jsonLike('title', "%$searchTerm%");
                })
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
        $country_id = (int) ($this->filters['country_id'] ?? 0);
        $region_id = (int) ($this->filters['region_id'] ?? 0);

        return [
            'country_id' => Filter::make(__('Countries'))
                ->select([0 => 'Всі'] + Country::select(['id', 'title'])->pluck('title', 'id')->toArray()),
            'region_id' => Filter::make(__('Regions'))
                ->select([0 => 'Всі'] + Region::where('country_id', $country_id)->select(['id', 'title'])->pluck('title', 'id')->toArray()),
            'district_id' => Filter::make(__('Districts'))
                ->select([0 => 'Всі'] + District::where('region_id', $region_id)->select(['id', 'title'])->pluck('title', 'id')->toArray()),
        ];
    }
}
