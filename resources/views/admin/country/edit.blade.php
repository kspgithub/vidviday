@extends('admin.layout.app')

@section('title', 'Редагування країни')

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.country.index'), 'title'=>__('Countries')],
    ['url'=>route('admin.country.edit', $country), 'title'=>__('Edit')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>Редагувати країну: {{$country->title}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.country.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.patch :action="route('admin.country.update', $country)" enctype="multipart/form-data" x-ref="form">
            @include('admin.country.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.patch>
    </div>

@endsection
