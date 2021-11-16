@extends('admin.layout.app')

@section('title', __('Transport'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.transport.index'), 'title'=>__('Transport')],
    ]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Transport')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.transport.create')}}" class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Image')</th>
                    <th>@lang('Title')</th>
                    <th>@lang('Text')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transports as $transport)
                    <tr>

                        <td>{{$transport->id}}</td>
                        <td>
                            <img src="{{$transport->image_url}}" alt="{{$transport->image_alt}}" style="height: 80px;">
                        </td>
                        <td>{{$transport->title}}</td>
                        <td>{{$transport->text}}</td>

                        <td>
                            @include('admin.partials.published', ['model' => $transport, 'updateUrl' => route('admin.transport.update', $transport)])
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button :href="route('admin.transport.edit', ['transport'=>$transport])"
                                                 text=""/>
                            <x-utils.delete-button :href="route('admin.transport.destroy', $transport)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
