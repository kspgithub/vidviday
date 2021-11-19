@extends('admin.layout.app')

@section('title', __('Region management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Region management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.region.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create region')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Country')</th>
                    <th>@lang('Region')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Links')</th>
                    <th>@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($regions as $region)
                    <tr>
                        <td>{{$region->id}}</td>
                        <td>{{$region->country->title ?? '-'}}</td>
                        <td>{{$region->title}}</td>
                        <td>{{$region->slug}}</td>
                        <td class="table-action">
                            <a href="{{route('admin.district.index', ['region_id'=>$region->id])}}"
                               class="btn btn-sm btn-outline-info">
                                @lang('Districts')
                            </a>
                            <a href="{{route('admin.city.index', ['region_id'=>$region->id])}}"
                               class="btn btn-sm btn-outline-info">
                                @lang('Cities')
                            </a>
                        </td>
                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.region.edit', $region)" text=""/>
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.region.destroy', $region)" text=""/>
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $regions->links() }}

@endsection

