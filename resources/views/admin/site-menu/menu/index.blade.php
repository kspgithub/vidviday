@extends('admin.layout.app')

@section('title', __('Menu management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Menu management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.menu.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create menu')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('title')</th>
                    <th>@lang('Slug')</th>
                    <th>@lang('Short description')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->title}}</td>
                        <td>{{$menu->slug}}</td>
                        <td>{{ $menu->short_description }}</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.menu.edit', ['menu'=>$menu])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.menu.destroy', $menu)" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
