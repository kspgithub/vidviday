@extends('admin.layout.app')

@section('title', __('Create').' '.__('Place'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.popular-tours.index'), 'title'=>__('Popular Tours')],
['url'=>route('admin.popular-tours.create'), 'title'=>__('Create')],
]) !!}

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

    <x-page.edit :title="__('Create').' '.__('Place')"
                 :backUrl="route('admin.popular-tours.index')"
                 :updateUrl="route('admin.popular-tours.store', request()->only('scope'))"
    >
        @include('admin.popular-tours.includes.form')
    </x-page.edit>


@endsection
