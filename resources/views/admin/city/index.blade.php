@extends('admin.layout.app')

@section('title', __('Cities'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
isset($district) ? ['url'=>route('admin.city.index', ['district_id'=>$district->id]), 'title'=>$district->title] : null,
['url'=>route('admin.city.index', ['region_id'=>request('region_id', 0), 'district_id'=>request('district_id', 0)]), 'title'=>__('Cities')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Cities')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.city.create', ['region_id'=>request()->input('region_id', 0), 'district_id'=>request()->input('district_id', 0)])}}"
                   class="btn btn-sm btn-outline-info">
                    <i data-feather="plus"></i> @lang('Create')
                </a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">


            <livewire:cities-table :district="isset($district) ? $district: null"
                                   :region="isset($region) ? $region:  null"/>

        </x-slot>
    </x-bootstrap.card>

@endsection


