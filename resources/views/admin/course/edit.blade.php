@extends('admin.layout.app')

@section('title', __('Course').' - '.__('Edit'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.course.index'), 'title'=>__('Courses')],
    ['url'=>route('admin.course.edit', $course), 'title'=>$course->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.course.update', $course)"
                 :back-url="route('admin.course.index')" :edit="true"
                 :title="__('Edit').' '.$course->title"
    >
        @include('admin.course.includes.form')
    </x-page.edit>

@endsection
