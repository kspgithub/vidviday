@extends('admin.layout.app')

@section('title', __('Achievements'))

@section('content')
    {!! breadcrumbs([
        ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
        ['url'=>route('admin.achievement.index'), 'title'=>__('Achievements')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Achievements') </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.achievement.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <div class="table-responsive">
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
                    @foreach($achievements as $achievement)
                        <tr>
                            <td>{{$achievement->id}}</td>
                            <td><img src="{{$achievement->image_url}}" alt="{{$achievement->image_alt}}"
                                     style="height: 56px;"></td>
                            <td>{!! $achievement->title !!}</td>
                            <td>
                                @include('admin.partials.published', ['model' => $achievement, 'updateUrl' => route('admin.achievement.update', $achievement)])
                            </td>
                            <td class="table-action">
                                <x-utils.edit-button :href="route('admin.achievement.edit', $achievement)" text=""/>
                                <x-utils.delete-button :href="route('admin.achievement.destroy', $achievement)"
                                                       text=""/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-bootstrap.card>

@endsection
