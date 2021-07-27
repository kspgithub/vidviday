@extends('admin.layout.app')

@section('title', __('Transport management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Transport management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.transport.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create transport')</a>
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
                @foreach($transports as $transport)
                    <tr>
                        <td>{{$transport->title}}</td>
                        <td>{{$transport->slug}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td><a href="{{route('admin.transport.media.index', ['transport'=>$transport])}}" class="badge bg-info"><span>{{$transport->media_count}}</span></a></td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.transport.edit', ['transport'=>$transport])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.transport.destroy', $transport)" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
