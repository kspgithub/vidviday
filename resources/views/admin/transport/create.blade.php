@extends('admin.layout.app')

@section('title', __('Create transport'))

@section('content')
    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.transport.index'), 'title'=>__('Transport')],
       ['url'=>route('admin.transport.create'), 'title'=>__('Create')],
   ]) !!}
    <x-page.edit :update-url="route('admin.transport.store')"
                 :back-url="route('admin.transport.index')"
                 :title="__('Create').' '.__('Transport')"
    >
        @include('admin.transport.includes.form')
    </x-page.edit>

@endsection
