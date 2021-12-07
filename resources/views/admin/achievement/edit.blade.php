@extends('admin.layout.app')

@section('title', __('Edit').': '.$achievement->title)

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.achievement.index'), 'title'=>__('Achievement')],
        ['url'=>route('admin.achievement.edit', $achievement), 'title'=>strip_tags($achievement->title)],
    ]) !!}
    <x-page.edit :update-url="route('admin.achievement.update', $achievement)"
                 :back-url="route('admin.achievement.index')" :edit="true"
                 :title="__('Edit').': '.html_entity_decode(strip_tags($achievement->title))"
    >
        @include('admin.achievement.includes.form')
    </x-page.edit>

@endsection
