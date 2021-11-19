@extends('admin.layout.app')

@section('title', __('Edit news'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.news.index'), 'title'=>__('News')],
['url'=>route('admin.news.edit', $news), 'title'=>$news->title],
]) !!}


    <x-page.edit :title=" __('Edit news').': '.$news->title"
                 :backUrl="route('admin.news.index')"
                 :updateUrl="route('admin.news.update', $news)"
                 :edit="true"
    >
        @include('admin.news.includes.form')
    </x-page.edit>

@endsection
