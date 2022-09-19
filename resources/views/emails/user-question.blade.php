@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Відгук</x-email.title>
        </div>

        <x-email.card>

            <p>Ім'я: {{ $userQuestion->name }}</p>
            <p>Телефон: {{ $userQuestion->phone }}</p>
            <p>Email: {{ $userQuestion->email }}</p>
            <p>Коментар: {{ $userQuestion->comment }}</p>
        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection
