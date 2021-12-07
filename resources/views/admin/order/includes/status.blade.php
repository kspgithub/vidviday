<div class="d-flex">
    <div class="me-2 mb-2">

    </div>

    <div class="btn-group-sm mb-2">
        @switch($order->status )
            @case(\App\Models\Order::STATUS_NEW)
            <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('New')
            </button>
            @break
            @case(\App\Models\Order::STATUS_PENDING_PAYMENT)
            <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Pending Payment')
            </button>
            @break
            @case(\App\Models\Order::STATUS_PROCESSING)
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Processing')
            </button>
            @break
            @case(\App\Models\Order::STATUS_PAYED)
            <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Payed')
            </button>
            @break
            @case(\App\Models\Order::STATUS_COMPLETED)
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Completed')
            </button>

            @break
            @case(\App\Models\Order::STATUS_MAINTENANCE)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Maintenance')
            </button>
            @break
            @case(\App\Models\Order::STATUS_PENDING_REJECT)
            <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Pending Reject')
            </button>
            @break
            @case(\App\Models\Order::STATUS_REJECTED)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Rejected')
            </button>
            @break
        @endswitch

        <ul class="dropdown-menu dropdown-menu-end">
            @foreach(\App\Models\Order::statuses() as $val=> $text)
                <li><a class="dropdown-item" href="#"
                       wire:click.prevent="changeStatus({{$order->id}},{{$val}})">{{$text}}</a></li>
            @endforeach

        </ul>
    </div>

</div>
