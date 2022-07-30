@extends('admin.layout.app')

@section('title', __('Question Types'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Question Types')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.question_types.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="plus"></i> Додати тип</a>
            @endif
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <x-bootstrap.card>
                <x-slot name="body">

                    <table class="table table-responsive table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Manager')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Published')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questionTypes as $questionType)
                            <tr>
                                <td>{{$questionType->id}}</td>
                                <td>{{$types[$questionType->type]}}</td>
                                <td>{{$questionType->title}}</td>
                                <td>{{$questionType->manager->name ?? ''}}</td>
                                <td>{{$questionType->email ?? ''}}</td>
                                <td>
                                    @include('admin.partials.published', ['model' => $questionType, 'updateUrl' => route('admin.question_types.update', $questionType)])
                                </td>
                                <td>
                                    <x-utils.edit-button :href="route('admin.question_types.edit', $questionType)"/>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </x-slot>
            </x-bootstrap.card>

        </div>
    </div>
@endsection

