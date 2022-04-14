<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Food;
use App\Models\FoodTime;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class FoodTable extends DataTableComponent
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

    public function query(): Builder
    {
        $region_id = (int)$this->getFilter('region_id');
        $time_id = (int)$this->getFilter('time_id');

        $query = Food::query()->with(['region', 'time'])->withCount('media')
            ->when($region_id > 0, function (Builder $q) use ($region_id) {
                return $q->where('region_id', $region_id);
            })
            ->when($time_id > 0, function (Builder $q) use ($time_id) {
                return $q->where('time_id', $time_id);
            });

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->searchable()
                ->sortable(),

            Column::make(__('Title'), 'title')
                ->searchable(function (Builder $query, $searchTerm) {
                    return $query->orJsonLike('title', "%$searchTerm%");
                })
                ->sortable(),

            Column::make(__('Time'), 'time_id')
                ->format(function ($value, $column, $row) {
                    return !empty($row->time) ? $row->time->title : '-';
                })
                ->sortable(),

            Column::make(__('Region'), 'region_id')
                ->format(function ($value, $column, $row) {
                    return !empty($row->region) ? $row->region->title : '-';
                })
                ->sortable(),

            Column::make(__('Country'), 'country_id')
                ->format(function ($value, $column, $row) {
                    return !empty($row->country) ? $row->country->title : '-';
                })
                ->sortable(),

            Column::make(__('Description'), 'text')
                ->format(function ($value, $column, $row) {
                    return strip_tags($row->text);
                })
                ->sortable(),

            Column::make(__('Price'), 'price')
                ->format(function ($value, $column, $row) {
                    return ($row->price ?? '0') . ' ' . $row->currency;
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.food.includes.actions', ['food' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'country_id' => Filter::make(__('Countries'))
                ->select(array_merge([0 => 'Всі'], Country::select(['id', 'title'])->pluck('title', 'id')->toArray())),
            'region_id' => Filter::make(__('Regions'))
                ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray())),
            'time_id' => Filter::make(__('Time'))
                ->select(array_merge([0 => 'Всі'], FoodTime::select(['id', 'title'])->pluck('title', 'id')->toArray())),
        ];
    }
}
