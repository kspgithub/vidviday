@extends('admin.layout.app')

@section('title', __('Edit place'))

@section('content')

    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.place.index'), 'title'=>__('Places')],
['url'=>route('admin.place.edit', $place), 'title'=>$place->title],
]) !!}


    <x-page.edit :title=" __('Edit place').': '.$place->title"
                 :backUrl="route('admin.place.index')"
                 :updateUrl="route('admin.place.update', $place)"
                 :edit="true"
    >
        @include('admin.place.includes.form')
    </x-page.edit>


@endsection
