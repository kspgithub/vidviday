@extends('admin.layout.app')

@section('title', __('Food'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Food')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.food.create')}}" class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Title')</th>
                    <th>@lang('Description')</th>
                    <th>@lang('Price')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{ strip_tags($item->text) }}</td>
                        <td class="text-nowrap">{{ $item->price }} {{ $item->currency }}</td>
                        <td class="table-action text-nowrap">
                            <x-utils.edit-button :href="route('admin.food.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.food.destroy', $item)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
