@extends('layout.app')
@section('title', 'Замовлення туру: '.$tour->title)
@section('content')
    <main class="order-page">
        <div v-is="'order-form'"
             action='{{route('tour.order-confirm', ['tour'=>$tour])}}'
             :current-step='{{(int)request()->input('step', 1)}}'
             :schedule-id='{{(int)request()->input('schedule', 0)}}'
             :tour='@json($tour->shortInfo())'
             :schedules='@json($schedules)'
             :discounts='@json($discounts)'
             :user='@json(auth()->check() ? current_user()->basicInfo() : null)'
             :rooms='@json($room_types)'
             :payment-types='@json($payment_types)'
             :confirmation-types='@json($confirmation_types)'
             :tour-selected='true'
             :order-corporate='{{$schedules->count() > 0 ? 'false' : 'true'}}'
        >
            @csrf
        </div>
        <div class="spacer-lg"></div>
    </main>

@endsection
