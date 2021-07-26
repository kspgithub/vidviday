@extends('admin.layout.app')

@section('title', __('Badges management'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Badges management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.badge.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create badge')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('color')</th>
                    <th>@lang('Url')</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($badges as $badge)
                    <tr>
                        <td>{{$badge->title}}</td>
                        <td>
                            <ul class="list-inline" style="margin-bottom:0 !important;">
                                <li class="list-inline-item align-items-center" style="vertical-align: middle;">{{$badge->color}}</li>
                                <li class="list-inline-item align-items-center" style="vertical-align: middle;padding:5px 0;float:right;margin-right:50%;"><div style="background-color: {{$badge->color}};width:50px;height:50px;"></div></li>
                            </ul>
                            </td>
                        <td>{{$badge->slug}}</td>
                        <td>{{$badge->slug}}</td>
                        <td class="table-action">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <x-utils.edit-button :href="route('admin.badge.edit', ['badge'=>$badge])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.badge.destroy', $badge)" text="" />
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
