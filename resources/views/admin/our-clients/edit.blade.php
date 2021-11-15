@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Our Clients'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.our-client.index'), 'title'=>__('Our Clients')],
        ['url'=>route('admin.our-client.edit', $ourClient), 'title'=>$ourClient->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.our-client.update', $ourClient)"
                 :back-url="route('admin.our-client.index')" :edit="true"
                 :title="__('Edit').': '.$ourClient->title"
    >
        @include('admin.our-clients.includes.form')
    </x-page.edit>

@endsection
