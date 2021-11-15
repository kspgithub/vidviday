@extends('admin.layout.app')

@section('title', __('Create').' '.__('Our Clients'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.our-client.index'), 'title'=>__('Our Clients')],
        ['url'=>route('admin.our-client.create'), 'title'=>__('Create')],
    ]) !!}
    <x-page.edit :update-url="route('admin.our-client.store')"
                 :back-url="route('admin.our-client.index')"
                 :title="__('Create').' '.__('Our Client')"
    >
        @include('admin.our-clients.includes.form')
    </x-page.edit>

@endsection
