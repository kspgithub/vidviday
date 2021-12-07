@extends('admin.layout.app')

@section('title', __('Create').' '.__('Achievements'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.achievement.index'), 'title'=>__('Achievements')],
        ['url'=>route('admin.achievement.create'), 'title'=>__('Create')],
    ]) !!}
    <x-page.edit :update-url="route('admin.achievement.store')"
                 :back-url="route('admin.achievement.index')"
                 :title="__('Create').' '.__('Achievement')"
    >
        @include('admin.achievement.includes.form')
    </x-page.edit>

@endsection
