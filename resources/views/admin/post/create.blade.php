@extends('admin.layout.app')

@section('title', __('Create').' '.__('Post'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.post.index'), 'title'=>__('Blog')],
['url'=>route('admin.post.create'), 'title'=>__('Create')],
]) !!}

    <x-page.edit :title="__('Create').' '.__('Post')"
                 :backUrl="route('admin.post.index')"
                 :updateUrl="route('admin.post.store')"
    >
        @include('admin.post.includes.form')
    </x-page.edit>



@endsection
