@extends('admin.layout.app')

@section('title', __('Create').' '.__('Place'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.place.index'), 'title'=>__('Places')],
['url'=>route('admin.place.create'), 'title'=>__('Create')],
]) !!}

    <x-page.edit :title="__('Create').' '.__('Place')"
                 :backUrl="route('admin.place.index')"
                 :updateUrl="route('admin.place.store')"
    >
        @include('admin.place.includes.form')
    </x-page.edit>
    

@endsection
