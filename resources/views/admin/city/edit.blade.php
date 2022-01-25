@extends('admin.layout.app')

@section('title', __('Edit city'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
isset($district) ? ['url'=>route('admin.city.index', ['district_id'=>$district->id]), 'title'=>$district->title] : null,
['url'=>route('admin.city.index', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)]), 'title'=>__('Cities')],
['url'=>route('admin.city.edit', ['city'=>$city, 'region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)]), 'title'=>$city->title],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Редагувати населений пункт: {{$city->title}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.city.index', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)])}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.patch :action="route('admin.city.update', $city)" enctype="multipart/form-data" x-ref="form">
            @include('admin.city.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.patch>
    </div>


@endsection
