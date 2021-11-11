@extends('admin.layout.app')

@section('title', __('Create').' '.__('Banner'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.banner.index'), 'title'=>__('Banners')],
        ['url'=>route('admin.banner.create'), 'title'=>__('Create')],
    ]) !!}
    <x-page.edit :update-url="route('admin.banner.store')"
                 :back-url="route('admin.banner.index')"
                 :title="__('Create').' '.__('Banner')"
    >
        @include('admin.banner.includes.form')
    </x-page.edit>

@endsection
