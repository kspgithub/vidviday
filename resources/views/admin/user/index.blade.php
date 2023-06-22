@extends('admin.layout.app')

@section('title', __('User Management'))

@section('content')
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.user.index'), 'title'=>__('Users')],
]) !!}

    <div class="d-flex justify-content-between">
        <h1>@lang('User Management')</h1>

        <div>
            <a href="{{route('admin.user.index', array_merge(request()->all(), ['export'=>1]))}}"
                target="_blank" class="btn btn-outline-success">
                <i class="far fa-file-excel"></i> Експортувати в Excel
            </a>
            <a href="{{route('admin.user.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="user-plus"></i> @lang('Create User')</a>
        </div>

    </div>

    @include('admin.user.includes.tabs')

    <div class="card">
        <div class="card-body">
            <livewire:users-table/>
        </div>
    </div>
@endsection
