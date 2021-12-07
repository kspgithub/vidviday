@extends('admin.layout.app')

@section('title', __('Event groups'))

@section('content')
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.event-group.index'), 'title'=>__('Event groups')],
  ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Event groups')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.event-group.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="user-plus"></i> @lang('Create record')</a>
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
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($eventGroups as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->slug}}</td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.event-group.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.event-group.destroy', $item)" text="" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
