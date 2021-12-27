@extends('admin.layout.app')

@section('title', 'Новий корпоратив')

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.corporate.index'), 'title'=>'Корпоративи'],
      ['url'=>route('admin.crm.corporate.create'), 'title'=>'Новий корпоратив'],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Новий корпоратив</h1>
    </div>

    @include('admin.crm.corporate.includes.form')

@endsection
