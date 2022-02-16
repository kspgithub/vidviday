@extends('admin.layout.app')

@section('title', __('Замовлення турів'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.order.index'), 'title'=>'Замовлення'],
]) !!}
    <div class="d-flex justify-content-between mb-4">
        <h1 class="mb-3">Замовлення турів</h1>
        <a href="{{route('admin.crm.order.create')}}" class="btn btn-success mb-3">
            <i class="fa fa-plus"></i> Створити замовлення
        </a>
    </div>
    @include('admin.crm.order.includes.list')
@endsection
