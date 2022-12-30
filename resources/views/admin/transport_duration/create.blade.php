@extends('admin.layout.app')

@section('title', __('Create') . ' ' . __('Transport duration'))

@section('content')
    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.transport_duration.index'), 'title'=>__('Transport duration')],
       ['url'=>route('admin.transport_duration.create'), 'title'=>__('Create')],
   ]) !!}
    <x-page.edit :update-url="route('admin.transport_duration.store')"
                 :back-url="route('admin.transport_duration.index')"
                 :title="__('Create').' '.__('Transport duration')"
    >
        @include('admin.transport_duration.includes.form')
    </x-page.edit>

@endsection
