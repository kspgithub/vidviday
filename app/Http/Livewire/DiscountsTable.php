<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class DiscountsTable extends DataTableComponent
{

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
        $query = Discount::query();

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

            Column::make(__('Title'), 'admin_title')
                ->format(function ($value, $column, $row) {
                    return !empty($row->admin_title) ? $row->admin_title : $row->title;
                })
                ->searchable()
                ->sortable(),

            Column::make(__('Type'), 'type')
                ->format(function ($value, $column, $row) {
                    return $row->type === Discount::TYPE_PERCENT ? '%' : __('sum');
                })
                ->sortable(),

            Column::make(__('Значення'), 'price')
                ->sortable(),

            Column::make(__('Currency'), 'currency')
                ->format(function ($value, $column, $row) {
                    return $row->type === Discount::TYPE_PERCENT ? '' : $row->currency;
                })
                ->sortable(),


            Column::make(__('Published'), 'published')
                ->format(function ($value, $column, $row) {
                    return view('admin.partials.published', ['model' => $row, 'updateUrl' => route('admin.discount.update', $row)]);
                })
                ->sortable(),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.discount.includes.actions', ['discount' => $row]);
                }),
        ];
    }
}
