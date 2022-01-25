@extends('admin.layout.app')

@section('title', __('Edit').' '.$district->title)

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
['url'=>route('admin.district.index'), 'title'=>__('Districts')],
['url'=>route('admin.district.edit', $district), 'title'=>$district->title],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Редагування району: {{$district->title}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.district.index',['region_id'=>request('region_id', 0)])}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.patch :action="route('admin.district.update', $district)" enctype="multipart/form-data" x-ref="form">
            @include('admin.district.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.patch>
    </div>


@endsection
