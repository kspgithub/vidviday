@extends('admin.layout.app')

@section('title', 'Редагування корпоративу №'.$order->id)

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.corporate.index'), 'title'=>'Корпоративи'],
      ['url'=>route('admin.crm.corporate.show', $order), 'title'=>'#'.$order->id],
      ['url'=>route('admin.crm.corporate.edit', $order), 'title'=>'Редагування'],
    ]) !!}
    <div class="text-center mb-3">
        <h1>{{ 'Редагування корпоративу №'.$order->id}}</h1>
    </div>

    @include('admin.crm.corporate.includes.form')

@endsection
