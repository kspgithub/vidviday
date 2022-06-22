<div class="bordered-box">
    <div class="row">
        <div class="col-6">
            <span class="text">@lang('order-section.type')</span>
        </div>

        <div class="col-6">
            <span class="text">
                <b>{{$order->type === 'sum' ? __('order-section.certificate.type-sum') : __('order-section.certificate.type-tour')}}</b>
            </span>
        </div>
    </div>
    <hr>
    @if($order->type === 'sum')
        <div class="row">
            <div class="col-6">
                <span class="text">@lang('order-section.sum')</span>
            </div>

            <div class="col-6">
                <span class="text"><b>{{$order->sum}} {{__('order-section.currency.uah')}}</b></span>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-6">
                <span class="text">{{__('order-section.tour')}}</span>
            </div>

            <div class="col-6">
                <span class="text"><b>{{$order->tour->title ?? '-'}}</b></span>
            </div>
        </div>
    @endif
    <hr>
    <div class="row">
        <div class="col-6">
            <span class="text">{{__('order-section.design')}}</span>
        </div>

        <div class="col-6">
            <span class="text">
                <b>{{$order->design === 'heart' ? __('order-section.certificate.design-heart') : __('order-section.certificate.design-classic')}}</b>
            </span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <span class="text">{{__('order-section.format')}}</span>
        </div>

        <div class="col-6">
            <span class="text">
                <b>{{$order->format === 'printed' ? __('order-section.certificate.format-printed') :  __('order-section.certificate.format-electronic')}}</b>
            </span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <span class="text">{{__('order-section.order-number')}}</span>
        </div>

        <div class="col-6">
            <span class="text"><b>{{$order->order_number}}</b></span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <span class="text">{{__('order-section.recipient-data')}}</span>
        </div>

        <div class="col-6">
            <span class="text"><b>{{$order->last_name_recipient}} {{$order->first_name_recipient}}</b></span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <span class="text">{{__('order-section.total-sum')}}</span>
        </div>

        <div class="col-6">
            <span class="text"><b>{{number_format($order->price, 0, '', ',')}} {{__('order-section.currency.uah')}}</b></span>
        </div>
    </div>
</div>
