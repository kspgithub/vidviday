@extends('admin.layout.app')

@section('title', __('Edit badge'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.badge.index'), 'title'=>__('Badges')],
    ['url'=>'#', 'title'=>$badge->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.badge.update', $badge)"
                 :back-url="route('admin.badge.index')" :edit="true"
                 :title="__('Edit').' '.__('Badges')"
    >
        @include('admin.badge.includes.form')
    </x-page.edit>


@endsection
