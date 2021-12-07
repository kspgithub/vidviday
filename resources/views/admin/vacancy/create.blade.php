@extends('admin.layout.app')

@section('title', __('Create').' '.__('Vacancy'))

@section('content')

    {!! breadcrumbs([
       ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
       ['url'=>route('admin.vacancy.index'), 'title'=>__('Vacancies')],
       ['url'=>route('admin.vacancy.create'), 'title'=>__('Create')],
   ]) !!}
    <x-page.edit :update-url="route('admin.vacancy.store')"
                 :back-url="route('admin.vacancy.index')"
                 :title="__('Create').' '.__('Vacancy')"
    >
        @include('admin.vacancy.includes.form')
    </x-page.edit>

@endsection
