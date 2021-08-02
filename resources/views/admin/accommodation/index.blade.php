@extends('admin.layout.app')

@section('title', __('Accommodations'))

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Accommodations')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.accommodation.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Text')</th>
                    <th>@lang('Key')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions') </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $model)
                    <tr>
                        <td>{{$model->title}}</td>
                        <td>{{$model->text}}</td>
                        <td>{{$model->slug}}</td>
                        <td>@include('admin.partials.published', ['updateUrl'=>route('admin.accommodation.update', $model)])</td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.accommodation.edit', $model)" text="" />
                            <x-utils.delete-button :href="route('admin.accommodation.destroy', $model)" text="" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
