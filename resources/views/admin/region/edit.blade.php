@extends('admin.layout.app')

@section('title', 'Редагувати область')

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.region.index'), 'title'=>__('Області')],
    ['url'=>route('admin.region.edit', $region), 'title'=>__('Edit')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Редагувати область: {{$region->title}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.region.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.patch :action="route('admin.region.update', $region)" enctype="multipart/form-data" x-ref="form">
            @include('admin.region.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.patch>
    </div>


@endsection
