@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>{{$messageSubject}}</x-email.title>
        </div>

        <x-email.card>
            {!! $messageText !!}
        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection