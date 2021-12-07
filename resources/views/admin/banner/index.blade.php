@extends('admin.layout.app')

@section('title', __('Banners'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.banner.index'), 'title'=>__('Banners')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Banners') </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.banner.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('Image')</th>
                    <th>@lang('Title')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{$banner->id}}</td>
                        <td><img src="{{$banner->image_url}}" alt="{{$banner->image_alt}}" style="height: 80px;"></td>
                        <td>{{$banner->title}}</td>
                        <td>{{$banner->url}}</td>
                        <td>
                            @include('admin.partials.published', ['model' => $banner, 'updateUrl' => route('admin.banner.update', $banner)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.banner.edit', $banner)" text=""/>
                            <x-utils.delete-button :href="route('admin.banner.destroy', $banner)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{$banners->links()}}
@endsection
