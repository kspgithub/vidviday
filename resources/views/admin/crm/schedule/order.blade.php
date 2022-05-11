@extends('admin.layout.app')

@section('title', 'Картка замовлення: '.$tour->title.', '.$schedule->start_title)

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.schedule.index'), 'title'=>'Список збірних виїздів'],
      ['url'=>route('admin.crm.schedule.show', $schedule), 'title'=>$tour->title.' - '.$schedule->start_title],
      ['url'=>route('admin.crm.schedule.order.show', [$schedule, $order]), 'title'=>'Замовлення #'.$order->id],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Картка замовлення: #{{$order->id}}</h1>
        <h2 class="text-muted">{{$tour->title}}, {{$schedule->start_title}}</h2>
    </div>

    @include('admin.crm.order.includes.form')
    @include('admin.crm.order.includes.audit')
{{--    @include('admin.crm.order.card')--}}

@endsection
