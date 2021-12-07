@extends('admin.layout.app')

@section('title', __('Districts'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
isset($region) ? ['url'=>route('admin.city.index', ['region_id'=>$region->id]), 'title'=>$region->title] : null,
['url'=>route('admin.district.index'), 'title'=>__('Districts')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Districts')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.district.create', ['region_id'=>request()->input('region_id', 0)])}}"
                   class="btn btn-sm btn-outline-info">
                    <i data-feather="plus"></i> @lang('Create')
                </a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">


            <livewire:districts-table :region="$region ?? null"/>

        </x-slot>
    </x-bootstrap.card>

@endsection

