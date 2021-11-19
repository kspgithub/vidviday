@extends('admin.layout.app')

@section('title', __('Create news'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.news.index'), 'title'=>__('News')],
['url'=>route('admin.news.create'), 'title'=>__('Create')],
]) !!}

    <x-page.edit :title="__('Create news')"
                 :backUrl="route('admin.news.index')"
                 :updateUrl="route('admin.news.store')"
    >
        @include('admin.news.includes.form')
    </x-page.edit>



@endsection
