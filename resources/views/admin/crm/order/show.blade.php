@extends('admin.layout.app')

@section('title', 'Картка замовлення: '.$tour->title.($schedule ? ', '.$schedule->start_title : ''))

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.order.index'), 'title'=>'Замовлення'],
      ['url'=>route('admin.crm.order.show', $order), 'title'=>'Замовлення #'.$order->id],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Картка замовлення: #{{$order->id}}</h1>
        <h2 class="text-muted">{{$tour->title.($schedule ? ', '.$schedule->start_title : '')}}</h2>
    </div>

    @include('admin.crm.order.card')

@endsection
