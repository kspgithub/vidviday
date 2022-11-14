<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\DeleteRecordTrait;
use App\Models\WrongQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class WrongRequestsTable.
 */
class WrongRequestsTable extends DataTableComponent
{
    use DeleteRecordTrait;

    public array $bulkActions = [];

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

    public $resetId;

    public function mount($region = null, $district = null): void
    {
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = WrongQuery::query();

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id'),

            Column::make(__('Query'), 'query')
                ->searchable()
                ->sortable(),

            Column::make(__('Count'), 'count')
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.wrong_requests.includes.actions', ['model' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        $filters = [];

        return $filters;
    }
}
