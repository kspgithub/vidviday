@extends('admin.layout.app')

@section('title', __('Accommodation Types'))

@section('content')
    {!! breadcrumbs([
 ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
 ['url'=>route('admin.accommodation-type.index'), 'title'=>__('Accommodation Types')],
 ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Accommodation Types')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.accommodation-type.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="plus"></i> @lang('Create')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>@lang('Title')</th>
                        <th>@lang('Description')</th>
                        <th>@lang('Key')</th>
                        <th>@lang('Actions') </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{$type->title}}</td>
                            <td>{{$type->description}}</td>
                            <td>{{$type->slug}}</td>
                            <td class="table-action">
                                <x-utils.edit-button :href="route('admin.accommodation-type.edit', $type)" text=""/>
                                @if(current_user()->isMasterAdmin())
                                    <x-utils.delete-button :href="route('admin.accommodation-type.destroy', $type)"
                                                           text=""/>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-bootstrap.card>
@endsection
