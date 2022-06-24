@extends('admin.layout.app')

@section('title', __('Courses'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.course.index'), 'title'=>__('Courses')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Courses')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.course.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->title}}</td>
                        <td>@include('admin.partials.published', ['model'=>$course, 'updateUrl'=>route('admin.course.update', $course)])</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.course.edit', ['course'=>$course])" text=""/>
                            <x-utils.delete-button :href="route('admin.course.destroy', ['course'=>$course])"
                                                   text=""/>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $courses->links() }}

@endsection

