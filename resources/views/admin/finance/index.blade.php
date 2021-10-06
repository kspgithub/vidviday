@extends('admin.layout.app')

@section('title', __('Finances'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Finances')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.finance.create', ['type_id'=>request()->input('type_id', 1)])}}"
               class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <div class="btn-group mb-3">
        <a href="{{route('admin.finance.index', ['type_id'=>1])}}"
           class="btn btn-outline-primary {{(int)request()->input('type_id', 1) === 1 ? 'active' : ''}}">
            У вартість входять
        </a>
        <a href="{{route('admin.finance.index', ['type_id'=>2])}}"
           class="btn btn-outline-primary {{(int)request()->input('type_id', 1) === 2 ? 'active' : ''}}">
            У вартість не входять
        </a>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Type')</th>
                    <th>@lang('Title')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->type ? $item->type->title : '-'}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->published}}</td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.finance.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.finance.destroy', $item)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
