@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Banner'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.banner.index'), 'title'=>__('Banners')],
        ['url'=>route('admin.banner.edit', $banner), 'title'=>$banner->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.banner.update', $banner)"
                 :back-url="route('admin.banner.index')" :edit="true"
                 :title="__('Edit').' '.__('Banner')"
    >
        @include('admin.banner.includes.form')
    </x-page.edit>

@endsection
