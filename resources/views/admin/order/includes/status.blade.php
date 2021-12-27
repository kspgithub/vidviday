<div class="d-flex">
    <div class="me-2 mb-2">

    </div>

    <div class="btn-group-sm mb-2">
        @switch($order->status )
            @case(\App\Models\Order::STATUS_NEW)
            <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.new')
            </button>
            @break
            @case(\App\Models\Order::STATUS_BOOKED)
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.booked')
            </button>
            @break
            @case(\App\Models\Order::STATUS_NOT_SENT)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.not-sent')
            </button>
            @break
            @case(\App\Models\Order::STATUS_INTERESTED)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.interested')
            </button>
            @break
            @case(\App\Models\Order::STATUS_RESERVE)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.reserve')
            </button>
            @break
            @case(\App\Models\Order::STATUS_DEPOSIT)
            <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.deposit')
            </button>
            @break

            @case(\App\Models\Order::STATUS_PAYED)
            <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('order-section.status.payed')
            </button>
            @break

            @case(\App\Models\Order::STATUS_PENDING_CANCEL)
            <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Pending Reject')
            </button>
            @break
            @case(\App\Models\Order::STATUS_CANCELED)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Rejected')
            </button>
            @break
            @case(\App\Models\Order::STATUS_COMPLETED)
            <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Completed')
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
