@extends('admin.layout.app')

@section('title', __('Create').' '.__('Direction'))

@section('content')

    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.direction.index'), 'title'=>__('Directions')],
['url'=>'#', 'title'=>__('Create')],
]) !!}

    <x-page.edit :update-url="route('admin.direction.store')"
                 :back-url="route('admin.direction.index')"
                 :title="__('Create').' '.__('Direction')"
    >
        @include('admin.direction.includes.form')
    </x-page.edit>

@endsection
