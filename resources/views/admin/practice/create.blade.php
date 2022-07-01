@extends('admin.layout.app')

@section('title', __('Create').' '.__('Practice'))

@section('content')

    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.practice.index'), 'title'=>__('Practices')],
       ['url'=>route('admin.practice.create'), 'title'=>__('Create')],
   ]) !!}
    <x-page.edit :update-url="route('admin.practice.store')"
                 :back-url="route('admin.practice.index')"
                 :title="__('Create').' '.__('Practice')"
    >
        @include('admin.practice.includes.form')
    </x-page.edit>

@endsection
