@extends('admin.layout.app')

@section('title', __('Event Group').' - '.__('Editing'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.event-group.index'), 'title'=>__('Event groups')],
['url'=>route('admin.event-group.edit', $eventGroup), 'title'=>$eventGroup->title],
]) !!}
    <x-page.edit :title="__('Edit Event group')"
                 :backUrl="route('admin.event-group.index')"
                 :updateUrl="route('admin.event-group.update', $eventGroup)"
    >
        @include('admin.event-group.includes.form')
    </x-page.edit>




@endsection
