@extends('admin.layout.app')

@section('title', __('Practices'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.practice.index'), 'title'=>__('Practices')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Practices')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.practice.create')}}" class="btn btn-sm btn-outline-info"><i
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
                @foreach($practices as $practice)
                    <tr>
                        <td>{{$practice->title}}</td>
                        <td>@include('admin.partials.published', ['model'=>$practice, 'updateUrl'=>route('admin.practice.update', $practice)])</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.practice.edit', ['practice'=>$practice])" text=""/>
                            <x-utils.delete-button :href="route('admin.practice.destroy', ['practice'=>$practice])"
                                                   text=""/>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $practices->links() }}

@endsection

