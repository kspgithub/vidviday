@extends('admin.layout.app')

@section('title', __('Vacancies'))

@section('content')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
    ['url'=>route('admin.vacancy.index'), 'title'=>__('Vacancies')],
    ]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('Vacancies')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.vacancy.create')}}" class="btn btn-sm btn-outline-info"><i
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
                @foreach($vacancies as $vacancy)
                    <tr>
                        <td>{{$vacancy->title}}</td>
                        <td>@include('admin.partials.published', ['model'=>$vacancy, 'updateUrl'=>route('admin.vacancy.update', $vacancy)])</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.vacancy.edit', ['vacancy'=>$vacancy])" text=""/>
                            <x-utils.delete-button :href="route('admin.vacancy.destroy', ['vacancy'=>$vacancy])"
                                                   text=""/>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $vacancies->links() }}

@endsection

