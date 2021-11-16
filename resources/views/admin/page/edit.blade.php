@extends('admin.layout.app')

@section('title', __('Edit page').': '.$page->title)

@section('content')
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
      ['url'=>route('admin.page.edit', $page), 'title'=>$page->title],
  ]) !!}

    <x-page.edit :title=" __('Edit page').': '.$page->title"
                 :backUrl="route('admin.page.index')"
                 :updateUrl="route('admin.page.update', $page)"
                 :edit="true"
    >
        @include('admin.page.includes.form')
    </x-page.edit>


@endsection
