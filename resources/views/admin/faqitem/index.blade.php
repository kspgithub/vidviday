@extends('admin.layout.app')

@section('title', __('FAQ'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.faqitem.index'), 'title'=> __('FAQ')],
    ['url'=>route('admin.faqitem.index', $section), 'title'=> \App\Models\FaqItem::$sections[$section]],
]) !!}
@endsection

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('FAQ')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin())
                <a href="{{route('admin.faqitem.create', $section)}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="plus"></i> Додати питання</a>
            @endif
        </div>
    </div>

    <div class="btn-group mb-3">
        @foreach(\App\Models\FaqItem::$sections as $sectionItem => $sectionTitle)
            <a href="{{route('admin.faqitem.index', $sectionItem)}}"
               class="btn btn-outline-primary {{$sectionItem === $section ? 'active' : ''}}">{{$sectionTitle}}</a>
        @endforeach
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            <h4>{{\App\Models\FaqItem::$sections[$section]}}</h4>

            <table class="table table-responsive table-striped table-sm" x-data='sortable({
                url: "{{route('admin.faqitem.sort')}}"
            })'>
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('Question')</th>
                    <th>@lang('Answer')</th>
                    <th>@lang('Published')</th>
                    <th style="width: 100px">@lang('Actions') </th>
                </tr>
                </thead>
                <tbody x-ref="sortableRef">
                @foreach($faqitems as $faqitem)
                    <tr class="draggable" data-id="{{$faqitem->id}}">
                        <td class="handler ps-2"><i class="fa fa-bars cursor-move me-3"></i></td>
                        <td>
                            {{$faqitem->question}}
                        </td>
                        <td>{{$faqitem->answer}}</td>
                        <td>@include('admin.partials.published', ['model'=>$faqitem, 'updateUrl'=>route('admin.faqitem.update', ['faqItem'=>$faqitem, 'section'=>$section])])</td>
                        <td class="table-action">
                            <x-utils.edit-button
                                :href="route('admin.faqitem.edit', ['faqItem'=>$faqitem, 'section'=>$section])"
                                text=""/>
                            <x-utils.delete-button
                                :href="route('admin.faqitem.destroy', ['faqItem'=>$faqitem, 'section'=>$section])"
                                text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
