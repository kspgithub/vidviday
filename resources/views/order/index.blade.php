@extends('layout.app')
@section('title', 'Замовлення туру')
@section('content')
    <main class="order-page">
        <div v-is="'order-form'"
             action='{{route('order.store')}}'
             :current-step='{{(int)request()->input('step', 1)}}'
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
