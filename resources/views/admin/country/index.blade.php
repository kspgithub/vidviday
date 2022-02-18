@extends('admin.layout.app')

@section('title', 'Країни')

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.country.index'), 'title'=>__('Countries')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>Країни</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.country.create')}}" class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('Iso')</th>
                    <th>Області</th>
                    <th style="width: 200px">@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{$country->title}}</td>
                        <td>{{$country->iso}}</td>
                        <td>
                            <a href="{{route('admin.region.index', ['country_id'=>$country->id])}}"
                               class="btn btn-sm btn-outline-info">
                                @lang('Regions')
                            </a>
                        </td>
                        <td>
                            <x-utils.edit-button :href="route('admin.country.edit', $country)" text=""/>
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.country.destroy', $country)" text=""/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $countries->links() }}

@endsection
