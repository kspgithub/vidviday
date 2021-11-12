@extends('admin.layout.app')

@section('title', __('Create').' '.__('Event Group'))

@section('content')
    {!! breadcrumbs([
 ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
 ['url'=>route('admin.event-group.index'), 'title'=>__('Event groups')],
 ['url'=>route('admin.event-group.create'), 'title'=>__('Create')],
]) !!}
    <x-page.edit :title="__('Create Event group')"
                 :backUrl="route('admin.event-group.index')"
                 :updateUrl="route('admin.event-group.store')"
    >
        @include('admin.event-group.includes.form')
    </x-page.edit>

@endsection
