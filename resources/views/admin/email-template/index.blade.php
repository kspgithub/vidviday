@extends('admin.layout.app')

@section('title', __('Email templates'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.email-templates.index'), 'title'=> __('Email templates')],
]) !!}
@endsection

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Email templates')</h1>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <table class="table table-responsive table-striped table-sm">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('Template')</th>
                    <th>@lang('Subject')</th>
                    <th>@lang('View')</th>
                    <th>@lang('Updated At')</th>
                    <th style="width: 100px">@lang('Actions') </th>
                </tr>
                </thead>
                <tbody x-ref="sortableRef">
                @foreach($templates as $template)
                    <tr>
                        <td class="handler ps-2">
                            @if($template['exists'])
                                <i class="fa fa-circle-check text-success"></i>
                            @endif
                        </td>
                        <td>
                            {{$template['mailable']}}
                        </td>
                        <td>
                            {{$template['subject']}}
                        </td>
                        <td>
                            {{$template['view']}}
                        </td>
                        <td>
                            {{$template['updated_at']}}
                        </td>
                        <td class="table-action">
                            <x-utils.edit-button
                                :href="route('admin.email-templates.edit', Str::replace('\\','-',$template['mailable']))"
                                text=""/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-bootstrap.card>
@endsection
