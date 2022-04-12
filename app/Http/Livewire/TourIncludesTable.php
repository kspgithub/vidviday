<?php

namespace App\Http\Livewire;


use App\Models\IncludeType;
use App\Models\TourInclude;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class TourIncludesTable extends DataTableComponent
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
     * @return Builder
     */
    public function query(): Builder
    {
        $query = TourInclude::query();

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

            Column::make(__('Published'), 'published')
                ->sortable(),


            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.tour-include.includes.actions', ['tourInclude' => $row]);
                }),
        ];
    }
}
