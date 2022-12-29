@extends('layout.app')
@section('title', 'Замовлення туру')
@section('content')
    <main class="order-page">
        <div v-is="'order-form'"
             action='{{route('order.store')}}'
             :prev-url='@json(url()->previous())'
             :current-step='{{(int)request()->input('step', 1)}}'
             :clear='{{(int)request()->input('clear', 0)}}'
             :schedule-id='null'
             :tour='null'
             :tour-selected='false'
             :schedules='[]'
             :discounts='[]'
             :order-corporate='{{$corporate ? 'true' : 'false'}}'
             :user='@json(auth()->check() ? current_user()->basicInfo() : null)'
             :rooms='@json($room_types)'
             :payment-types='@json($payment_types)'
             :confirmation-types='@json($confirmation_types)'
        >
            @csrf
        </div>
        <div class="spacer-lg"></div>
    </main>

@endsection
