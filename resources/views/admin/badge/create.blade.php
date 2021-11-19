@extends('admin.layout.app')

@section('title', __('Create badge'))

@section('content')
    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
       ['url'=>route('admin.badge.index'), 'title'=>__('Badges')],
       ['url'=>'#', 'title'=>__('Create')],
       ]) !!}
    <x-page.edit :update-url="route('admin.badge.store')"
                 :back-url="route('admin.badge.index')" :edit="true"
                 :title="__('Create').' '.__('Badge')"
    >
        @include('admin.badge.includes.form')
    </x-page.edit>
@endsection
