@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Post'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.post.index'), 'title'=>__('Blog')],
['url'=>route('admin.post.edit', $post), 'title'=>$post->title],
]) !!}


    <x-page.edit :title=" __('Edit').' '.__('Post').': '.$post->title"
                 :backUrl="route('admin.post.index')"
                 :updateUrl="route('admin.post.update', $post)"
                 :edit="true"
    >
        @include('admin.post.includes.form')
    </x-page.edit>

@endsection
