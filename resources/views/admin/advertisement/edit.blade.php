@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Advertisement'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.advertisement.index'), 'title'=>__('Advertisement')],
        ['url'=>route('admin.advertisement.edit', $advertisement), 'title'=>$advertisement->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.advertisement.update', $advertisement)"
                 :back-url="route('admin.advertisement.index')" :edit="true"
                 :title="__('Edit').' '.__('Advertisement')"
    >
        @include('admin.advertisement.includes.form')
    </x-page.edit>

@endsection
