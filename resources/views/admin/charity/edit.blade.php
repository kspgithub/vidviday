@extends('admin.layout.app')

@section('title', __('Edit charity'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.charity.index'), 'title'=>__('Charity')],
['url'=>route('admin.charity.edit', $charity), 'title'=>$charity->title],
]) !!}


    <x-page.edit :title=" __('Edit charity').': '.$charity->title"
                 :backUrl="route('admin.charity.index')"
                 :updateUrl="route('admin.charity.update', $charity)"
                 :edit="true"
    >
        @include('admin.charity.includes.form')
    </x-page.edit>

@endsection
