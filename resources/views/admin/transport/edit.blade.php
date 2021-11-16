@extends('admin.layout.app')

@section('title', __('Edit transport'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.transport.index'), 'title'=>__('Transport')],
    ['url'=>route('admin.transport.edit', $transport), 'title'=>$transport->title],
]) !!}
    <x-page.edit :update-url="route('admin.transport.update', $transport)"
                 :back-url="route('admin.transport.index')" :edit="true"
                 :title="__('Edit').' '.$transport->title"
    >
        @include('admin.transport.includes.form')
    </x-page.edit>


@endsection
