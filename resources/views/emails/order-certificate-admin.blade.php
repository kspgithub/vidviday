@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Замовлення сертифікату #{{$order->order_number}}</x-email.title>
        </div>

        <x-email.card>
            <x-email.table>
                <x-email.row title="Номер замовлення">{{$order->order_number}}</x-email.row>
                <x-email.row title="Ім'я">{{$order->last_name}} {{$order->first_name}}</x-email.row>
                <x-email.row title="Телефон">{{$order->phone ?? '-'}}</x-email.row>
                <x-email.row title="Email">{{$order->email ?? '-'}}</x-email.row>
                <x-email.row title="Тип">{{$order->type === 'sum' ? 'На суму' : 'На мандрівку'}}</x-email.row>
                @if($order->type === 'sum')
                    <x-email.row title="Сума">{{number_format($order->sum, 0, '', ',')}} грн.</x-email.row>
                @else
                    <x-email.row title="Тур">{{$order->tour?->title ?? '-'}}</x-email.row>
                @endif
                <x-email.row title="Дизайн">{{$order->design === 'heart' ? 'У формі серця' : 'Класичний'}}</x-email.row>
                <x-email.row
                    title="Формат">{{$order->format === 'printed' ? 'Друкований' : 'Електронний'}}</x-email.row>
                <x-email.row
                    title="Данні отримувача">{{$order->last_name_recipient}} {{$order->first_name_recipient}}</x-email.row>
                <x-email.row title="Загальна сума">{{number_format($order->price, 0, '', ',')}} грн.</x-email.row>
                <x-email.row title="Побажання замовника">
                    {{ $order->comment }}
                </x-email.row>
            </x-email.table>

        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection
