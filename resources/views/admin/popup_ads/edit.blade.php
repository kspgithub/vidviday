@extends('admin.layout.app')

@section('title', __('Edit').' '.__('Advertisement'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.popup_ads.index'), 'title'=>__('Advertisement')],
        ['url'=>route('admin.popup_ads.edit', $advertisement), 'title'=>$advertisement->title],
    ]) !!}
    <x-page.edit :update-url="route('admin.popup_ads.update', $advertisement)"
                 :back-url="route('admin.popup_ads.index')" :edit="true"
                 :title="__('Edit').' '.__('Advertisement')"
    >
        @include('admin.popup_ads.includes.form')
    </x-page.edit>

@endsection
