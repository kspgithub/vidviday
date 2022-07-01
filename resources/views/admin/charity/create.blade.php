@extends('admin.layout.app')

@section('title', __('Create charity'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.charity.index'), 'title'=>__('Charity')],
['url'=>route('admin.charity.create'), 'title'=>__('Create')],
]) !!}

    <x-page.edit :title="__('Create charity')"
                 :backUrl="route('admin.charity.index')"
                 :updateUrl="route('admin.charity.store')"
    >
        @include('admin.charity.includes.form')
    </x-page.edit>



@endsection
