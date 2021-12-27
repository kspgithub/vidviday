@extends('admin.layout.app')

@section('title', 'Редагування замовлення №'.$order->id)

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.order.index'), 'title'=>'Замовлення'],
      ['url'=>route('admin.crm.order.show', $order), 'title'=>'#'.$order->id],
      ['url'=>route('admin.crm.order.edit', $order), 'title'=>'Редагування'],
    ]) !!}
    <div class="text-center mb-3">
        <h1>{{ 'Редагування замовлення №'.$order->id}}</h1>
    </div>

    @include('admin.crm.order.includes.form')

@endsection
