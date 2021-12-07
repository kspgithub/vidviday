@extends('admin.layout.app')

@section('title', __('Create page'))

@section('content')
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
      ['url'=>route('admin.page.create'), 'title'=>__('Create')],
  ]) !!}

    <x-page.edit :title="__('Create page')"
                 :backUrl="route('admin.page.index')"
                 :updateUrl="route('admin.page.store')"
    >
        @include('admin.page.includes.form')
    </x-page.edit>

@endsection
