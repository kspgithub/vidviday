<?php

namespace App\Http\Livewire;

use App\Models\Accommodation;
use App\Models\Region;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class AccommodationsTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

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
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {

        $region_id = (int)$this->getFilter('region_id');

        $query = Accommodation::query()
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

            Column::make(__('Title'), 'title')
                ->searchable()
                ->sortable(),

            Column::make(__('Region'), 'region_id')
                ->format(function ($value, $column, $row) {
                    return optional($row->region)->title;
                })
                ->sortable(),

            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.accommodation.update-status', $row)]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.accommodation.includes.actions', ['accommodation' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            'region_id' => Filter::make(__('Regions'))
                ->select(array_merge([0 => 'Всі'], Region::select(['id', 'title'])->pluck('title', 'id')->toArray())),
        ];
    }
}
