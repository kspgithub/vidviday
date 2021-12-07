@extends('admin.layout.app')

@section('title', __('Create').' '.__('Advertisement'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.advertisement.index'), 'title'=>__('Advertisements')],
        ['url'=>route('admin.advertisement.create'), 'title'=>__('Create')],
    ]) !!}
    <x-page.edit :update-url="route('admin.advertisement.store')"
                 :back-url="route('admin.advertisement.index')"
                 :title="__('Create').' '.__('Advertisement')"
    >
        @include('admin.advertisement.includes.form')
    </x-page.edit>

@endsection
