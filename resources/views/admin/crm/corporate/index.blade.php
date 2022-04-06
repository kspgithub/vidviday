@extends('admin.layout.app')

@section('title', __('Замовлення корпоративів'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.corporate.index'), 'title'=>'Корпоративи'],
]) !!}
    <div class="d-flex justify-content-between mb-4">
        <h1 class="mb-3">Замовлення корпоративів</h1>
        <a href="{{route('admin.crm.corporate.create')}}" class="btn btn-success mb-3">
            <i class="fa fa-plus"></i> Створити замовлення
        </a>
    </div>

    @include('admin.crm.corporate.includes.list')
@endsection
