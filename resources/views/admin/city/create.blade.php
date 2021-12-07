@extends('admin.layout.app')

@section('title', __('Create city'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
isset($district) ? ['url'=>route('admin.city.index', ['district_id'=>$district->id]), 'title'=>$district->title] : null,
['url'=>route('admin.city.index', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)]), 'title'=>__('Cities')],
['url'=>route('admin.city.create', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)]), 'title'=>__('Create')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Create city')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.city.index', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)])}}"
               class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
        </div>
    </div>

    <x-forms.post :action="route('admin.city.store')" enctype="multipart/form-data">
        <x-bootstrap.card>
            <x-slot name="body">
                @include('admin.city.includes.form')
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-primary" type="submit">@lang('Save')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.post>


@endsection
