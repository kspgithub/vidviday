@extends('admin.layout.app')

@section('title', __('Vacancy').' - '.__('Edit'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.vacancy.index'), 'title'=>__('Vacancies')],
    ['url'=>route('admin.vacancy.edit', $vacancy), 'title'=>$vacancy->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.vacancy.update', $vacancy)"
                 :back-url="route('admin.vacancy.index')" :edit="true"
                 :title="__('Edit').' '.$vacancy->title"
    >
        @include('admin.vacancy.includes.form')
    </x-page.edit>

@endsection
