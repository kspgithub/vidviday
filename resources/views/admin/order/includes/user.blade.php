<div class="text-nowrap">{{$order->last_name}} {{$order->first_name}}</div>
@if($order->phone)
    <div class="text-nowrap"><a href="tel:{{clear_phone($order->phone)}}">{{$order->phone}}</a></div>
@endif
