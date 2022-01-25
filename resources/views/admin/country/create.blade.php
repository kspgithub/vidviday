@extends('admin.layout.app')

@section('title', 'Додати країну')

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.country.index'), 'title'=>__('Countries')],
    ['url'=>route('admin.country.create'), 'title'=>__('Create')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Додати країну</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.district.index',['region_id'=>request('region_id', 0)])}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.post :action="route('admin.country.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.country.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>


@endsection
