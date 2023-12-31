<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use App\Models\StaffType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class StaffsTable.
 */
class StaffsTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

    public string $defaultSortColumn = 'last_name';

    public string $defaultSortDirection = 'asc';

    public bool $singleColumnSorting = true;

    public function mount(): void
    {
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $type = $this->getFilter('type');
        $query = Staff::query()->when(!empty($type), fn ($query) => $query->whereHas('types', fn ($q) => $q->where('slug', $type)))
            ->withCount(['tours']);

        return $query;
    }

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-responsive',
    ];


    /**
     * @return array
     */
    public function columns(): array
    {
        return [

            Column::make(__('ID'), 'id')
                ->searchable()
                ->sortable(),
            Column::make(__('Користувач'))
                ->format(function ($value, $column, $row) {
                    return $row->user_id > 0 ? "<a href='/admin/user/$row->user_id' target='_blank'>$row->user_id</a>   " : '-';
                })->asHtml(),

            Column::make(__('Ім\'я'), 'last_name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy('last_name', $direction);
                })
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->whereRaw("CONCAT_WS(' ', last_name, first_name) LIKE '%$searchTerm%'");
                })
                ->format(function ($value, $column, $row) {
                    return $row->last_name . ' ' . $row->first_name;
                }),


            Column::make(__('Type'), 'type')
                ->format(function ($value, $column, $row) {
                    return $row->types->implode('title', ', ');
                })
                ->sortable()
                ->searchable(),

            Column::make(__('Tours'), 'tours_count')
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.staff.includes.actions', ['staff' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'type' => Filter::make('Type')
                ->select(array_merge(['' => 'Любой'], StaffType::toSelectArray('title', 'slug'))),

        ];
    }
}
