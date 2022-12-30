@extends('admin.layout.app')

@section('title', __('Transport duration'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.transport_duration.index'), 'title'=>__('Transport duration')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Transport duration')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.transport_duration.create')}}" class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Title')</th>
                    <th>@lang('Value')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transportDurations as $transportDuration)
                    <tr>

                        <td>{{$transportDuration->id}}</td>
                        <td>{{$transportDuration->title}}</td>
                        <td>{{$transportDuration->value}}</td>
                        <td>
                            @include('admin.partials.published', ['model' => $transportDuration, 'updateUrl' => route('admin.transport_duration.update', $transportDuration)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.transport_duration.edit', $transportDuration)"
                                                 text=""/>
                            <x-utils.delete-button :href="route('admin.transport_duration.destroy', $transportDuration)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
