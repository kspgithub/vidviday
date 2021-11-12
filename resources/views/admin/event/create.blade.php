@extends('admin.layout.app')

@section('title', __('Create event'))

@section('content')
    {!! breadcrumbs([
     ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
     ['url'=>route('admin.event.index'), 'title'=>__('Events')],
     ['url'=>route('admin.event.create'), 'title'=>__('Create event')],
 ]) !!}
    <x-page.edit :title="__('Create event')"
                 :backUrl="route('admin.event.index')"
                 :updateUrl="route('admin.event.store')"
    >
        @include('admin.event.includes.form')
    </x-page.edit>


@endsection
