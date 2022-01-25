@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Замовлення транспорту #{{$order->id}}</x-email.title>
        </div>

        <x-email.card>
            <x-email.table>
                <x-email.row title="Номер замовлення">{{$order->id}}</x-email.row>
                <x-email.row title="Ім'я">{{$order->last_name}} {{$order->first_name}}</x-email.row>
                <x-email.row title="Телефон">{{$order->phone ?? '-'}}</x-email.row>
                <x-email.row title="Email">{{$order->email ?? '-'}}</x-email.row>
                <x-email.row title="Viber">{{$order->viber ?? '-'}}</x-email.row>
                <x-email.row title="Дата виїзду">{{$order->start_date->format('d.m.Y') ?? '-'}}</x-email.row>
                <x-email.row title="Тривалість">{{$order->duration}}</x-email.row>
                <x-email.row title="Маршрут">{{$order->route}}</x-email.row>
                <x-email.row title="Кількість пасажирів">{{$order->places}}</x-email.row>
                <x-email.row title="Вікова група пасажирів">{{$order->age_group_title}}</x-email.row>
                <x-email.row title="Коментар">{{$order->comment ?? '-'}}</x-email.row>
            </x-email.table>

        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection
