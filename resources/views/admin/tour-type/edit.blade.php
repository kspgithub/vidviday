@extends('admin.layout.app')

@section('title', __('Edit').' '.$tourType->title)

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-group.index'), 'title'=>__('Tour Types')],
['url'=>route('admin.tour-group.edit', $tourType), 'title'=>$tourType->title],
]) !!}

    <x-page.edit :update-url="route('admin.tour-type.update', $tourType)"
                 :back-url="route('admin.tour-type.index')" :edit="true"
                 :title="__('Edit').' '.$tourType->title"
    >
        @include('admin.tour-type.includes.form')
    </x-page.edit>
    
@endsection
