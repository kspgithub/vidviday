@extends('admin.layout.app')

@section('title', __('Charity'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.partner.index'), 'title'=>__('Партнеры')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Партнеры')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.partner.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Домен</th>
                    <th>Авторизаційний токен</th>
                    {{--                    <th>Налаштування</th>--}}
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td>{{$partner->id}}</td>
                        <td>{{$partner->title}}</td>
                        <td>{{$partner->domain}}</td>
                        <td>{{$partner->token}}</td>
                        {{--                        <td></td>--}}
                        <td>
                            <x-utils.edit-button :href="route('admin.partner.edit', $partner)" text=""/>
                            <x-utils.delete-button :href="route('admin.partner.destroy', $partner)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
