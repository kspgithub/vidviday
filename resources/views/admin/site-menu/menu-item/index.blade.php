@extends('admin.layout.app')

@section('title', __('Menu item management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Menu item management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.menu-item.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create record')</a>
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
                    <th>@lang('Position')</th>
                    <th>@lang('Parent')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menuItems as $menuItem)
                    <tr>
                        <td>{{$menuItem->title}}</td>
                        <td>{{$menuItem->slug}}</td>
                        <td>{{ $menuItem->position }}</td>
                        <td>{{ $menuItem->parent_menu }}</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.menu-item.edit', ['menu_item'=>$menuItem])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.menu-item.destroy', $menuItem)" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
