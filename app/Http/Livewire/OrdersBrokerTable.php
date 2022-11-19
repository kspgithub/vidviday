<?php

namespace App\Http\Livewire;


use App\Models\OrderBroker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class OrdersBrokerTable.
 */
class OrdersBrokerTable extends DataTableComponent
{
    public array $bulkActions = [
    ];

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
        $query = OrderBroker::query()->with(['user']);

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

            Column::make(__('User'), 'last_name')
                ->format(function ($value, $column, $row) {
                    return view('admin.order.includes.user', ['order' => $row]);
                })
                ->asHtml()
                ->searchable()
                ->sortable(),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at?->format('d.m.Y H:i') : '-';
                })
                ->searchable()
                ->sortable(),

            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.order-broker.includes.status', ['order' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.order-broker.includes.actions', ['order' => $row]);
                }),
        ];
    }


    public function changeStatus($order_id, $status)
    {
        $order = OrderBroker::find($order_id);
        $order->status = $status;
        $order->save();

    }
}
