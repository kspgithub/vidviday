@extends('admin.layout.app')

@section('title', __('Місця посадки'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
    ['url'=>route('admin.landing-place.index'), 'title'=>__('Місця посадки')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Місця посадки')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.landing-place.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create Record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('Title')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>
                            @include('admin.partials.published', ['model' => $item, 'updateUrl' => route('admin.landing-place.update', $item)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.landing-place.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.landing-place.destroy', $item)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-slot>
    </x-bootstrap.card>
    {{$items->links()}}
@endsection
