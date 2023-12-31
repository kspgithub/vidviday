@extends('emails.layout')

@section('content')
    <div class="body">
        <div style="text-align: center;">
            <span
                style="font-family: 'Roboto', sans-serif; font-weight: 500; font-size: 16px; line-height: 28px; color: #626262;">
                Тестування емейлу
            </span>
            <br>
        </div>

        <div class="card">
            <div style="padding: 15px 20px 30px; border-bottom: 1px solid #E9E9E9;">
                {!! $mess !!}
            </div>
        </div>

        <div style="text-align: center; margin-bottom: 30px;">
            <span style="font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 24px; color: #626262;">Дякуємо за те, що обрали нас!</span>
        </div>
    </div>

@endsection
