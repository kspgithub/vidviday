@extends('admin.layout.app')

@section('title', __('Accommodation').' - '.__('Create'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.accommodation.index'), 'title'=>__('Accommodations')],
['url'=>route('admin.accommodation.create'), 'title'=>__('Create')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>{{__('Accommodation').' - '.__('Create')}}
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation.index')}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable()">
        <x-forms.post :action="route('admin.accommodation.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.accommodation.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
        </x-forms.post>
    </div>


@endsection
