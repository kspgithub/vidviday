@extends('admin.layout.app')

@section('title', __('Create').' '.__('Місце посадки'))

@section('content')

    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.landing-place.index'), 'title'=>__('Місця посадки')],
['url'=>'#', 'title'=>__('Create')],
]) !!}

    <x-page.edit :update-url="route('admin.landing-place.store')"
                 :back-url="route('admin.landing-place.index')"
                 :title="__('Create').' '.__('Місце посадки')"
    >
        @include('admin.landing-place.includes.form')
    </x-page.edit>

@endsection
