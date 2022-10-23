@extends('admin.layout.app')

@section('title', __('Edit transport duration'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.transport_duration.index'), 'title'=>__('Transport')],
    ['url'=>route('admin.transport_duration.edit', $transportDuration), 'title'=>$transportDuration->title],
]) !!}
    <x-page.edit :update-url="route('admin.transport_duration.update', $transportDuration)"
                 :back-url="route('admin.transport_duration.index')" :edit="true"
                 :title="__('Edit').' '.$transportDuration->title"
    >
        @include('admin.transport_duration.includes.form')
    </x-page.edit>


@endsection
