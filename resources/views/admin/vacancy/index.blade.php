@extends('admin.layout.app')

@section('title', __('Vacancy management'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Vacancy management')</h1>

        <div class="d-flex align-items-center">
                <a href="{{route('admin.vacancy.create')}}" class="btn btn-sm btn-outline-info"><i data-feather="plus"></i> @lang('Create vacancy')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th>@lang('title')</th>
                    <th>@lang('Pablished')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vacancies as $vacancy)
                    <tr>
                        <td>{{$vacancy->title}}</td>
                        <td>{{$vacancy->published}}</td>
                        <td>{{app()->getLocale()}}</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.vacancy.edit', ['vacancy'=>$vacancy])" text="" />
                            <x-utils.delete-button :href="route('admin.vacancy.destroy', ['vacancy'=>$vacancy])" text="" />

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{ $vacancies->links() }}

@endsection

