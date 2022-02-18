@extends('admin.layout.app')

@section('title', __('Food'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>@lang('Food')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.food.create', ['time_id'=>request('time_id', ''), 'region_id'=>request('region_id', '')])}}"
               class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <form class="row" id="filter-form" onchange="this.submit()">
        <div class="col mb-3">
            <div class="btn-group">
                <input type="radio" class="btn-check" value="" name="time_id" id="time_id_0"
                       autocomplete="off" {{request('time_id', 0) === 0 ? 'checked' : ''}} >
                <label class="btn btn-outline-primary" for="time_id_0">Всі</label>

                @foreach($foodTimes as $foodTime)
                    <input type="radio" class="btn-check" value="{{$foodTime->id}}" name="time_id"
                           id="time_id_{{$foodTime->id}}"
                           autocomplete="off" {{(int)request('time_id', 0) === $foodTime->id ? 'checked' : ''}} >
                    <label class="btn btn-outline-primary" for="time_id_{{$foodTime->id}}">{{$foodTime->title}}</label>
                @endforeach
            </div>
        </div>
        <div class="col-auto mb-3">

            <select name="region_id" id="region_id" class="form-control">
                <option value="">Область</option>
                @foreach($regions as $region)
                    <option
                        value="{{$region['value']}}" {{request('region_id', 0) == $region['value'] ? 'selected' : ''}}>{{$region['text']}}</option>
                @endforeach
            </select>
        </div>
    </form>


    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('Title')</th>
                    <th>@lang('Time')</th>
                    <th>@lang('Region')</th>
                    <th>@lang('Description')</th>

                    <th>@lang('Price')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td class="text-nowrap">{{ $item->time ?  $item->time->title : '-'}}</td>
                        <td class="text-nowrap">{{ $item->region ?  $item->region->title : '-'}}</td>
                        <td>{{ strip_tags($item->text) }}</td>
                        <td class="text-nowrap">{{ $item->price ?? '0' }} {{ $item->currency }}</td>

                        <td class="table-action text-nowrap">
                            <x-utils.edit-button :href="route('admin.food.edit', $item)" text=""/>
                            <x-utils.delete-button :href="route('admin.food.destroy', $item)" text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

    {{$items->links()}}
@endsection
