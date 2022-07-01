@extends('admin.layout.app')

@section('title', __('Practice').' - '.__('Edit'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.practice.index'), 'title'=>__('Practices')],
    ['url'=>route('admin.practice.edit', $practice), 'title'=>$practice->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.practice.update', $practice)"
                 :back-url="route('admin.practice.index')" :edit="true"
                 :title="__('Edit').' '.$practice->title"
    >
        @include('admin.practice.includes.form')
    </x-page.edit>

@endsection
