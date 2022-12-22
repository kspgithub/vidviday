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

            <table class="table table-responsive table-striped table-sm" x-data='sortable({
                url: "{{route('admin.country.sort')}}"
            })'>
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('title')</th>
                    <th>@lang('Iso')</th>
                    <th>Області</th>
                    <th>Опубліковано</th>
                    <th style="width: 200px">@lang('Actions') </th>
                </tr>
                </thead>
                <tbody x-ref="sortableRef">
                @foreach($countries as $country)
                    <tr class="draggable" data-id="{{$country->id}}">
                        <td class="handler ps-2"><i class="fa fa-bars cursor-move me-3"></i></td>
                        <td>{{$country->title}}</td>
                        <td>{{$country->iso}}</td>
                        <td>
                            <a href="{{route('admin.region.index', ['country_id'=>$country->id])}}"
                               class="btn btn-sm btn-outline-info">
                                @lang('Regions')
                            </a>
                        </td>
                        <td>@include('admin.partials.published', ['model'=>$country, 'updateUrl'=>route('admin.country.update', $country->slug)])</td>
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
