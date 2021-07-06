@extends('admin.layout.app')

@section('title', __('direction management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Direction management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.direction.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create direction')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('title')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Media')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($directions as $direction)
                    <tr>
                        <td>{{$direction->title}}</td>
                        <td>{{$direction->slug}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td><a href="{{route('admin.direction.media.index', ['direction'=>$direction])}}" class="badge bg-info"><span>{{$direction->media_count}}</span></a></td>
                        <td class="table-action">

                            <x-utils.view-button :href="route('admin.direction.show', ['direction'=>$direction])" text="" />
                            <x-utils.edit-button :href="route('admin.direction.edit', ['direction'=>$direction])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.direction.destroy', $direction)" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
