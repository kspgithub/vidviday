@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Відгук</x-email.title>
        </div>

        <x-email.card>
            @if($testimonial->guide)
                <p>
                    @lang('Guide'): <a href="{{$testimonial->guide->url}}">{{$testimonial->guide->name}}</a>
                </p>
            @elseif($testimonial->tour)
                <p>
                    @lang('Tour'): <a href="{{$testimonial->tour->url}}">{{$testimonial->tour->title}}</a>
                </p>
            @elseif($testimonial->place)
                <p>
                    @lang('Place'): <a href="{{$testimonial->place->url}}">{{$testimonial->place->title}}</a>
                </p>
            @endif
            <p>Ім'я: {{ $testimonial->name }}</p>
            <p>Ім'я: {{ $testimonial->name }}</p>
            <p>Телефон: {{ $testimonial->phone }}</p>
            <p>Email: {{ $testimonial->email }}</p>
            <p>Коментар: {{ $testimonial->comment }}</p>
        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection
