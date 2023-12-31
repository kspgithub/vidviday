@extends('admin.layout.app')

@section('title', __('Tour categories'))

@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
   ['url'=>route('admin.tour-group.index'), 'title'=>__('Categories')],
   ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour categories')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.tour-group.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="user-plus"></i> @lang('Create record')</a>
            @endif
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
                    <th>@lang('Tours')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tourGroups as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->slug}}</td>
                        <td><span class="badge bg-info">{{$item->media_count}}</span></td>
                        <td><span class="badge bg-primary">{{$item->tours_count}}</span></td>
                        <td>
                            @include('admin.partials.published', ['model' => $item, 'updateUrl' => route('admin.tour-group.update', $item)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.tour-group.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.tour-group.destroy', $item)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
    {{$tourGroups->links()}}
@endsection
