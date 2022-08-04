@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.sub-title> Замовлення туру #{{$order->order_number}}</x-email.sub-title>
            <br>
            @if(!empty($order->tour))
                <x-email.title>{{$order->tour->title}}</x-email.title>
            @endif
        </div>

        <x-email.card>
            <p style="margin-bottom: 10px">Статус вашего замовлення змінено на <b>"{{$order->status_text}}"</b></p>

            {!! $notifyMessage !!}
        </x-email.card>
        
        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>
@endsection
