@extends('admin.layout.app')

@section('title', __('Popular Tours'))

@section('content')
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.popular-tours.index'), 'title'=>__('Popular Tours')],
]) !!}


    <div class="d-flex justify-content-between">
        <h1>@lang('Popular Tours')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.popular-tours.create', request()->only(['scope']))}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="plus"></i> @lang('Create record')</a>
        </div>

        <div>
            <form>
                <select name="scope" onchange="this.form.submit()">
                    <option value=""> --- </option>
                    @foreach($scopes as $id => $name)
                        <option value="{{$id}}" {{ request('scope') === $id ? 'selected="selected"' : '' }}>{{$name}}</option>
                    @endforeach
                </select>
            </form>
        </div>

    </div>

    @include('admin.popular-tours.includes.list')

@endsection
