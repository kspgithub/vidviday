@extends('admin.layout.app')

@section('title', __('Create').' '.__('Advertisement'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.popup_ads.index'), 'title'=>__('Advertisements')],
        ['url'=>route('admin.popup_ads.create'), 'title'=>__('Create')],
    ]) !!}
    <x-page.edit :update-url="route('admin.popup_ads.store')"
                 :back-url="route('admin.popup_ads.index')"
                 :title="__('Create').' '.__('Advertisement')"
    >
        @include('admin.popup_ads.includes.form')
    </x-page.edit>

@endsection
