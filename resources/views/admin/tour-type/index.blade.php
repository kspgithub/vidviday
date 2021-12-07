@extends('admin.layout.app')

@section('title', __('Tour Types'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour-type.index'), 'title'=>__('Tour Types')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Types')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-type.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create Record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('title')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @if($tourTypes)
                    @foreach($tourTypes as $tourType)
                        <tr>
                            <td>{{$tourType->title}}</td>
                            <td>{{$tourType->slug}}</td>
                            <td>
                                @include('admin.partials.published', ['model' => $tourType, 'updateUrl' => route('admin.tour-type.update', $tourType)])
                            </td>
                            <td class="table-action">

                                <x-utils.edit-button :href="route('admin.tour-type.edit', $tourType)"
                                                     text=""/>
                                <x-utils.delete-button :href="route('admin.tour-type.destroy', $tourType)" text=""/>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
