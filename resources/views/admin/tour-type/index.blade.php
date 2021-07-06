@extends('admin.layout.app')

@section('title', __('Tour Types management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Types management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.tour-type.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create Tour Type')</a>
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
{{--                    <th>@lang('Media')</th>--}}
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @if($tourTypes)
                    @foreach($tourTypes as $tourType)
                        <tr>
                            <td>{{$tourType->title}}</td>
                            <td>{{$tourType->slug}}</td>
                            <td>{{app()->getLocale()}}</td>
{{--                            <td><a href="{{route('admin.tour-type.media.index', ['tourtype'=>$tourtype])}}" class="badge bg-info"><span>{{$tourtype->media_count}}</span></a></td>--}}
                            <td class="table-action">

                                <x-utils.edit-button :href="route('admin.tour-type.edit', ['tour_type'=>$tourType])" text="" />
                                @if(current_user()->isMasterAdmin())
                                    <x-utils.delete-button :href="route('admin.tour-type.destroy', $tourType)" text="" />
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
