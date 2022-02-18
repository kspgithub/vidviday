@extends('admin.layout.app')

@section('title', __('Edit').' '.$model->title)

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.landing-place.index'), 'title'=>__('Місця посадки')],
['url'=>route('admin.landing-place.edit', $model), 'title'=>$model->title],
]) !!}

    <x-page.edit :update-url="route('admin.landing-place.update', $model)"
                 :back-url="route('admin.landing-place.index')" :edit="true"
                 :title="__('Edit').': '.$model->title"
    >
        @include('admin.landing-place.includes.form')
    </x-page.edit>


@endsection
