@extends('admin.layout.app')

@section('title', __('Create').' '.__('Tour Type'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-type.index'), 'title'=>__('Tour Types')],
['url'=>'#', 'title'=>__('Create')],
]) !!}

    <x-page.edit :update-url="route('admin.tour-type.store')"
                 :back-url="route('admin.tour-type.index')"
                 :title="__('Create').' '.__('Tour Type')"
    >
        @include('admin.tour-type.includes.form')
    </x-page.edit>


@endsection
