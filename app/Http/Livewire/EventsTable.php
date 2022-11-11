<?php

namespace App\Http\Livewire;

use App\Models\Direction;
use App\Models\EventGroup;
use App\Models\EventItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class EventsTable extends DataTableComponent
{
    public array $bulkActions = [];

    /**
     * @var string
     */
    public string $defaultSortColumn = 'start_date';

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
        $direction_id = (int) $this->getFilter('direction');
        $group_id = (int) $this->getFilter('group');

        $query = EventItem::query()->with(['directions', 'groups'])
            ->when($direction_id > 0, fn ($q) => $q->whereHas('directions', fn ($sq) => $sq->where('id', $direction_id)))
            ->when($group_id > 0, fn ($q) => $q->whereHas('groups', fn ($sq) => $sq->where('id', $group_id)));

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
                ->searchable()
                ->sortable(),

            Column::make(__('Directions'))
                ->format(function ($value, $column, $row) {
                    return $row->directions->implode('title', ', ');
                }),

            Column::make(__('Groups'))
                ->format(function ($value, $column, $row) {
                    return $row->groups->implode('title', ', ');
                }),
            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.event.update-status', $row)]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.event.includes.actions', ['event' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'direction' => Filter::make(__('Direction'))
                ->select(array_merge([0 => 'Всі'], Direction::toSelectArray())),
            'group' => Filter::make(__('Group'))
                ->select(array_merge([0 => 'Всі'], EventGroup::toSelectArray())),
        ];
    }
}
