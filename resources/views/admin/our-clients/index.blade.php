@extends('admin.layout.app')

@section('title', __('Our Clients'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.our-client.index'), 'title'=>__('Our Clients')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Our Clients') </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.our-client.create')}}" class="btn btn-sm btn-outline-info"><i
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
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td><img src="{{$client->image_url}}" alt="{{$client->image_alt}}"
                                 style="height: 56px;"></td>
                        <td>{{$client->title}}</td>
                        <td>
                            @include('admin.partials.published', ['model' => $client, 'updateUrl' => route('admin.our-client.update', $client)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.our-client.edit', $client)" text=""/>
                            <x-utils.delete-button :href="route('admin.our-client.destroy', $client)"
                                                   text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
