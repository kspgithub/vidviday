@extends('admin.layout.app')

@section('title', __('Create').' '.__('Tour Group'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-group.index'), 'title'=>__('Groups')],
['url'=>'#', 'title'=>__('Create')],
]) !!}

    <x-page.edit :update-url="route('admin.tour-group.store')"
                 :back-url="route('admin.tour-group.index')"
                 :title="__('Create').' '.__('Tour Group')"
    >
        @include('admin.tour-group.includes.form')
    </x-page.edit>

@endsection
