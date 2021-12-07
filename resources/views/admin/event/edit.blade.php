@extends('admin.layout.app')

@section('title', __('Edit event').' - '.$event->title)

@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.event.index'), 'title'=>__('Events')],
   ['url'=>route('admin.event.edit', $event), 'title'=>$event->title],
]) !!}
    <x-page.edit :title="__('Edit event').' - '.$event->title"
                 :backUrl="route('admin.event.index')"
                 :updateUrl="route('admin.event.update', $event)"
                 :edit="true"
    >
        @include('admin.event.includes.form')
    </x-page.edit>

@endsection
