@extends('admin.layout.app')

@section('title', 'Нове замовлення')

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.order.index'), 'title'=>'Замовлення'],
      ['url'=>route('admin.crm.order.create'), 'title'=>'Нове замовлення'],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Нове замовлення</h1>
    </div>

    @include('admin.crm.order.includes.form')

@endsection
