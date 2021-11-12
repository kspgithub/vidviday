@extends('admin.layout.app')

@section('title', __('Edit page').': '.$page->title)

@section('content')
    <x-page.edit :title=" __('Edit page').': '.$page->title"
                 :backUrl="route('admin.page.index')"
                 :updateUrl="route('admin.page.update', $page)"
                 :edit="true"
    >
        @include('admin.page.includes.form')
    </x-page.edit>


@endsection
