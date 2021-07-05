@extends('admin.layout.app')

@section('title', __('Tour Subjects management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Subjects management')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.tour-subjects.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="user-plus"></i> @lang('Create Tour Subject')</a>
            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('title')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Media')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tourSubjects as $tourSubject)
                    <tr>
                        <td>{{$tourSubject->title}}</td>
                        <td>{{$tourSubject->slug}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td><a href="{{route('admin.tour-subjects.media.index', ['tourSubject'=>$tourSubject])}}" class="badge bg-info"><span>{{$tourSubject->media_count}}</span></a></td>
                        <td class="table-action">

                            <x-utils.view-button :href="route('admin.tour-subjects.show', ['tourSubject'=>$tourSubject])" text="" />
                            <x-utils.edit-button :href="route('admin.tour-subjects.edit', ['tourSubject'=>$tourSubject])" text="" />
                            @if(current_user()->isMasterAdmin())
                                <x-utils.delete-button :href="route('admin.tour-subjects.destroy', $tourSubject)" text="" />
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
