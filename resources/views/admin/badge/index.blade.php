@extends('admin.layout.app')

@section('title', __('Badges'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.badge.index'), 'title'=>__('Badges')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Badges management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.badge.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create badge')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('color')</th>
                    <th>@lang('Key')</th>
                    <th>@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($badges as $badge)
                    <tr>
                        <td>{{$badge->title}}</td>
                        <td>
                            <div style="background-color: {{$badge->color}};width:50px;height:20px;"></div>
                        </td>
                        <td>{{$badge->slug}}</td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.badge.edit', ['badge'=>$badge])" text=""/>
                            <x-utils.delete-button :href="route('admin.badge.destroy', $badge)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
