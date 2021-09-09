<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use App\Models\StaffType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class StaffsTable.
 */
class StaffsTable extends DataTableComponent
{

    /**
     * @var string
     */
    public $sortField = 'id';

    public function mount(): void
    {
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
       $query = Staff::query();

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


            Column::make(__('First name'), 'first_name')
                ->sortable(),
            Column::make(__('Last name'), 'last_name')
                ->sortable(),

            Column::make(__('Type'), 'type')
                ->format(function ($value, $column, $row) {
                    return $row->types->implode('title');
            })
                ->sortable()
                ->searchable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.staff.includes.actions', ['staff' => $row]);
                }),
        ];
    }

}
