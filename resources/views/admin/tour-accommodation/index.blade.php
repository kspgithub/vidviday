@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Accommodation'))

@section('content')
    <div class="d-flex justify-content-between">
        <h1>@lang('Tour') "{{$tour->title}}" - @lang('Accommodation')
            <div class="badge bg-info text-uppercase">{{app()->getLocale()}}</div>
        </h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.tour.accomm.create', $tour)}}"
               class="btn btn-sm btn-outline-secondary">@lang('Create')</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">

            <x-bootstrap.card>
                <x-slot name="body">
                    <h2>@lang('Accommodation')</h2>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Садиба</th>
                                <th scope="col">Типи кімнат</th>
                                <th scope="col">Заголовок</th>
                                <th scope="col">Підпис</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <th scope="row"><span class="handler"></span></th>
                                    <td>{{$item->accommodation->title}}</td>
                                    <td class="text-nowrap">{!! $item->types->implode('title', '<br>') !!}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->text}}</td>
                                    <td>
                                        <x-utils.edit-button class="me-2 mb-2" :text="''"
                                                             :href="route('admin.tour.accomm.edit', [$tour, $item])"

                                        />
                                        <x-utils.delete-button class="me-2 mb-2" :text="''"
                                                               :href="route('admin.tour.accomm.destroy', [$tour, $item])"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </x-slot>

            </x-bootstrap.card>


        </div>
    </div>



@endsection
