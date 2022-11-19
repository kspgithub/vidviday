<div class="d-flex">
    <div class="me-2 mb-2">

    </div>

    <div class="btn-group-sm mb-2">
        @switch($order->status )
            @case(\App\Models\OrderBroker::STATUS_NEW)
            <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('New')
            </button>
            @break

            @case(\App\Models\OrderBroker::STATUS_PROCESSING)
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Processing')
            </button>
            @break
            @case(\App\Models\OrderBroker::STATUS_COMPLETED)
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Completed')
            </button>

            @break

            @case(\App\Models\OrderBroker::STATUS_REJECTED)
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                @lang('Rejected')
            </button>
            @break
        @endswitch

        <ul class="dropdown-menu dropdown-menu-end">
            @foreach(\App\Models\OrderBroker::statuses() as $val=> $text)
                <li><a class="dropdown-item" href="#"
                       wire:click.prevent="changeStatus({{$order->id}},{{$val}})">{{$text}}</a></li>
            @endforeach

        </ul>
    </div>

</div>
