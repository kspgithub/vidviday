@extends('admin.layout.app')

@section('title', __('Create').' '.__('District'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    isset($country) ? ['url'=>route('admin.country.index'), 'title'=>'Країни'] : null,
    isset($country) ? ['url'=>route('admin.country.edit', $country), 'title'=>$country->title] : null,
    isset($country) ? ['url'=>route('admin.region.index', ['country_id'=>$country->id]), 'title'=>'Області'] : null,
    isset($region) ? ['url'=>route('admin.region.edit', $region), 'title'=>$region->title] : null,
    isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
    ['url'=>route('admin.district.index', ['region_id'=>$region ? $region->id : '']), 'title'=>__('Districts')],
    ['url'=>route('admin.district.create'), 'title'=>__('Create')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>{{__('Create').' '.__('District')}}</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.district.index')}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <div x-data="translatable({expanded:  true})">
        <x-forms.post :action="route('admin.district.store')" enctype="multipart/form-data" x-ref="form">
            @include('admin.district.includes.form')
            <button class="btn btn-primary" type="submit" x-on:click.prevent="submit($event)">@lang('Save')</button>
        </x-forms.post>
    </div>


@endsection
