<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class OrdersTable extends DataTableComponent
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

    public $payment_types = [];

    public function mount(): void
    {
        $this->payment_types = PaymentType::toSelectArray();
    }

    /**
     * @return Builder|Relation
     */
    public function query(): Builder|Relation
    {
        $query = Order::query()->with(['tour', 'user', 'schedule']);

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

            Column::make(__('Tour'), 'tour.title')
                ->format(function ($value, $column, $row) {
                    return $row->tour ? "<a href='{$row->tour->url}' target='_blank'>{$row->tour->title}</a>" : '';
                })
                ->asHtml()
                ->sortable(),

            Column::make(__('Departure Date'), 'start_date')
                ->format(function ($value, $column, $row) {
                    return $row->start_date ? $row->start_date->format('d.m.Y') : '-';
                })
                ->searchable()
                ->sortable(),

            Column::make(__('Group Type'), 'group_type')
                ->format(function ($value, $column, $row) {
                    return $row->group_type === Order::GROUP_CORPORATE ? 'Корпоративна' : 'Збірна';
                })
                ->sortable(),

            Column::make(__('Places'), 'places')
                ->format(function ($value, $column, $row) {
                    return $row->places.($row->children == 1 ? ' ('.($row->children_older + $row->children_young).'д)' : '');
                })
                ->sortable(),
            Column::make(__('Total'), 'price')
                ->format(function ($value, $column, $row) {
                    return '<span class="text-nowrap">'.number_format($row->total_price).' '.$row->currency.'</span>';
                })
                ->asHtml()
                ->sortable(),

            Column::make(__('User'), 'last_name')
                ->format(function ($value, $column, $row) {
                    return view('admin.order.includes.user', ['order' => $row]);
                })
                ->asHtml()
                ->sortable(),

            Column::make(__('Created At'), 'created_at')
                ->format(function ($value, $column, $row) {
                    return $row->created_at ? $row->created_at?->format('d.m.Y H:i') : '-';
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Payment Type'))
                ->format(function ($value, $column, $row) {
                    return view('admin.order.includes.payment-type', ['order' => $row, 'payment_types' => $this->payment_types]);
                }),
            Column::make(__('Status'))
                ->format(function ($value, $column, $row) {
                    return view('admin.order.includes.status', ['order' => $row]);
                }),

            Column::make(__('Actions'))
                ->format(function ($value, $column, $row) {
                    return view('admin.order.includes.actions', ['order' => $row]);
                }),
        ];
    }

    public function changeStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = (int) $status;
        $order->save();
    }
}
