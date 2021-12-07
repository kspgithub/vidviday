@extends('admin.layout.app')

@section('title', __('Directions'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.direction.index'), 'title'=>__('Directions')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Directions')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.direction.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create Record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Title')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Media')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($directions as $direction)
                    <tr>
                        <td>{{$direction->title}}</td>
                        <td>{{$direction->slug}}</td>
                        <td><span class="badge bg-info">{{$direction->media_count}}</span></td>
                        <td>
                            @include('admin.partials.published', ['model' => $direction, 'updateUrl' => route('admin.direction.update', $direction)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.direction.edit', ['direction'=>$direction])"
                                                 text=""/>
                            <x-utils.delete-button :href="route('admin.direction.destroy', $direction)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
