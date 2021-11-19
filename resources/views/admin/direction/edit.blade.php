@extends('admin.layout.app')

@section('title', __('Edit').' '.$direction->title)

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.direction.index'), 'title'=>__('Directions')],
['url'=>route('admin.direction.edit', $direction), 'title'=>$direction->title],
]) !!}

    <x-page.edit :update-url="route('admin.direction.update', $direction)"
                 :back-url="route('admin.direction.index')" :edit="true"
                 :title="__('Edit').': '.$direction->title"
    >
        @include('admin.direction.includes.form')
    </x-page.edit>


@endsection
