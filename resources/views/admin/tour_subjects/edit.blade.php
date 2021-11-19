@extends('admin.layout.app')

@section('title', __('Edit Tour Subject'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-subjects.index'), 'title'=>__('Subjects')],
['url'=>route('admin.tour-subjects.edit', $tourSubject), 'title'=>$tourSubject->title],
]) !!}

    <x-page.edit :update-url="route('admin.tour-group.update', $tourSubject)"
                 :back-url="route('admin.tour-group.index')" :edit="true"
                 :title="__('Edit').' '.$tourSubject->title"
    >
        @include('admin.tour_subjects.includes.form')
    </x-page.edit>



@endsection
