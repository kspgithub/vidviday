@extends('admin.layout.app')

@section('title', __('Page management'))

@section('content')
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.page.index'), 'title'=>__('Site pages')],
  ]) !!}


    <div class="d-flex justify-content-between">
        <h1>@lang('Page management')</h1>

        <div class="d-flex align-items-center">
            <a href="{{route('admin.page.create')}}" class="btn btn-sm btn-outline-info"><i
                    data-feather="user-plus"></i> @lang('Create page')</a>
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>

                    <th>@lang('title')</th>
                    <th>@lang('Locale')</th>
                    <th>@lang('Key')</th>
                    <th>@lang('Url')</th>
                    <th>@lang('Media')</th>
                    <th>@lang('Published')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{$page->title}}</td>
                        <td>{{strtoupper(app()->getLocale())}}</td>
                        <td>{{$page->key}}</td>
                        <td>/{{$page->slug}}</td>

                        <td><span class="badge bg-info">{{$page->media_count}}</span></td>
                        <td>@include('admin.partials.published', ['model'=>$page, 'updateUrl'=>route('admin.page.update', $page)])</td>
                        <td class="table-action">

                            <x-utils.edit-button :href="route('admin.page.edit', ['page'=>$page])" text=""/>
                            @if(!$page->main)
                                <x-utils.delete-button :href="route('admin.page.destroy', $page)" text=""/>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>

@endsection
