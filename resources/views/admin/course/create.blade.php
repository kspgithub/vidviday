@extends('admin.layout.app')

@section('title', __('Create').' '.__('Course'))

@section('content')

    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.course.index'), 'title'=>__('Courses')],
       ['url'=>route('admin.course.create'), 'title'=>__('Create')],
   ]) !!}
    <x-page.edit :update-url="route('admin.course.store')"
                 :back-url="route('admin.course.index')"
                 :title="__('Create').' '.__('Course')"
    >
        @include('admin.course.includes.form')
    </x-page.edit>

@endsection
