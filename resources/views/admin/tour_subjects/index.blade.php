@extends('admin.layout.app')

@section('title', __('Tour Subjects'))

@section('content')
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
  ['url'=>route('admin.tour-subjects.index'), 'title'=>__('Subjects')],
  ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Tour Subjects')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour-subjects.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="user-plus"></i> @lang('Create Tour Subject')</a>
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
                @if($tourSubjects)
                    @foreach($tourSubjects as $tourSubject)
                        <tr>
                            <td>{{$tourSubject->title}}</td>
                            <td>{{$tourSubject->slug}}</td>
                            <td>
                                @include('admin.partials.published', ['model' => $tourSubject, 'updateUrl' => route('admin.tour-subjects.update', $tourSubject)])
                            </td>
                            <td class="table-action">

                                <x-utils.edit-button
                                    :href="route('admin.tour-subjects.edit', ['tour_subject'=>$tourSubject])" text=""/>
                                @if(current_user()->isMasterAdmin())
                                    <x-utils.delete-button :href="route('admin.tour-subjects.destroy', $tourSubject)"
                                                           text=""/>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
