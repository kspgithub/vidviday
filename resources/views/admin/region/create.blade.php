@extends('admin.layout.app')

@section('title', 'Створити область')

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.region.index'), 'title'=>__('Області')],
        ['url'=>route('admin.region.create'), 'title'=>__('Create')],
        ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Створити область</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.region.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.post :action="route('admin.region.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.region.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>


@endsection
