@switch($order->status )
    @case(\App\Models\Order::STATUS_NEW)
    <span class="badge bg-info">
        @lang('New')
    </span>
    @break
    @case(\App\Models\Order::STATUS_PENDING_PAYMENT)
    <span class="badge bg-warning">
        @lang('Pending Payment')
    </span>
    @break
    @case(\App\Models\Order::STATUS_PROCESSING)
    <span class="badge bg-primary">
        @lang('Processing')
    </span>
    @break
    @case(\App\Models\Order::STATUS_PAYED)
    <span class="badge bg-success">
        @lang('Payed')
    </span>
    @break
    @case(\App\Models\Order::STATUS_COMPLETED)
    <span class="badge bg-primary">
        @lang('Completed')
    </span>
    @break
    @case(\App\Models\Order::STATUS_PENDING_REJECT)
    <span class="badge bg-danger">
        @lang('Pending Reject')
    </span>
    @break
    @case(\App\Models\Order::STATUS_MAINTENANCE)
    <span class="badge bg-secondary">
        @lang('Maintenance')
    </span>
    @break
    @case(\App\Models\Order::STATUS_REJECTED)
    <span class="badge bg-secondary">
        @lang('Rejected')
    </span>
    @break
@endswitch
