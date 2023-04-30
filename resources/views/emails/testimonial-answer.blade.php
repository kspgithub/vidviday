@extends('emails.layout')

@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Відповідь на ваше повідомлення.</x-email.title>
        </div>

        <x-email.card>
            @if($testimonial->guide)
                <p>
                    @lang('Guide'): <a href="{{asset($testimonial->guide->url)}}">{{$testimonial->guide->name}}</a>
                </p>
            @elseif($testimonial->tour)
                <p>
                    @lang('Tour'): <a href="{{asset($testimonial->tour->url)}}">{{$testimonial->tour->title}}</a>
                </p>
            @elseif($testimonial->place)
                <p>
                    @lang('Place'): <a href="{{asset($testimonial->place->url)}}">{{$testimonial->place->title}}</a>
                </p>
            @endif

            @if($testimonial->parent)
                <hr>
                <p>Ваше повідомлення: {{ $testimonial->parent->text }}</p>
                <p>Час: {{ $testimonial->parent->created_at }}</p>
                <hr>
            @endif

            <p>Ім'я: {{ $testimonial->name }}</p>
            <p>Телефон: {{ $testimonial->phone }}</p>
            <p>Email: {{ $testimonial->email }}</p>
            <p>Коментар: {{ $testimonial->text }}</p>
            <p>Час: {{ $testimonial->created_at }}</p>
        </x-email.card>

        <x-email.thanks>Дякуємо за те, що обрали нас!</x-email.thanks>
    </div>

@endsection
