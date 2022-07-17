@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Voting'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Voting')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Voting')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">

            <table class="table table-sm mb-3">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('User')</th>
                    <th>@lang('Ip')</th>
                    <th>@lang('Date')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tour->votings as $voting)
                    <tr>
                        <td>{{$voting->id}}</td>
                        <td>
                            {{$voting->name}}
                            {{$voting->phone}}
                            {{$voting->email}}
                        </td>
                        <td>{{ $voting->ip }}</td>
                        <td>{{ $voting->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
