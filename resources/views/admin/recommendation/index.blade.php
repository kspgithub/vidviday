@extends('admin.layout.app')

@section('title', __('Page management'))

@section('content')
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
      ['url'=>route('admin.page.edit', $page), 'title'=>$page->title],
      ['url'=>route('admin.page.recommendation.index', $page), 'title'=>'Рекомендації'],
  ]) !!}


    <div class="d-flex justify-content-between">
        <h1>{{$page->title}} - Рекомендації</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.recommendation.create', $page)}}" class="btn btn-sm btn-outline-info">
                <i data-feather="plus"></i> @lang('Create')
            </a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm" x-data='sortable({
                url: "{{route('admin.page.recommendation.sort')}}"
            })'>
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('Name')</th>
                    <th>@lang('Text')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody x-ref="sortableRef">
                @foreach($recommendations as $recommendation)
                    <tr class="draggable" data-id="{{$recommendation->id}}">
                        <td class="handler ps-2"><i class="fa fa-bars cursor-move me-3"></i></td>
                        <td>{{$recommendation->name}}</td>
                        <td>{{str_limit(strip_tags($recommendation->text), 100)}}</td>
                        <td>{{$recommendation->published}}</td>

                        <td class="table-action">

                            <x-utils.edit-button
                                :href="route('admin.page.recommendation.edit', ['page'=>$page, 'recommendation'=>$recommendation])"
                                text=""/>
                            @if(!$page->main)
                                <x-utils.delete-button
                                    :href="route('admin.page.recommendation.destroy', ['page'=>$page, 'recommendation'=>$recommendation])"
                                    text=""/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
