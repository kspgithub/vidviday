@extends('admin.layout.app')

@section('title', __('Tour Group').' - '.__('Editing'))

@section('content')
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
  ['url'=>route('admin.tour-group.index'), 'title'=>__('Categories')],
  ['url'=>route('admin.tour-group.edit', $tourGroup), 'title'=>$tourGroup->title],
  ]) !!}

    <x-page.edit :update-url="route('admin.tour-group.update', $tourGroup)"
                 :back-url="route('admin.tour-group.index')" :edit="true"
                 :title="__('Edit').' '.$tourGroup->title"
    >
        @include('admin.tour-group.includes.form')
    </x-page.edit>

@endsection
