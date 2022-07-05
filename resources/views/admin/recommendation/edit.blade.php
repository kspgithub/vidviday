@extends('admin.layout.app')

@section('title', 'Створити рекомендацію')

@section('content')
    {!! breadcrumbs([
     ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
     ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
     ['url'=>route('admin.page.edit', $page), 'title'=>$page->title],
     ['url'=>route('admin.page.recommendation.index', $page), 'title'=>'Рекомендації'],
     ['url'=>'#', 'title'=>'#'.$recommendation->id],
 ]) !!}
    <x-page.edit :update-url="route('admin.page.recommendation.update', [$page, $recommendation])"
                 :back-url="route('admin.page.recommendation.index', $page)" :edit="true"
                 :title="$page->title .' - Створити рекомендацію'"
    >
        @include('admin.recommendation.includes.form')
    </x-page.edit>
@endsection
