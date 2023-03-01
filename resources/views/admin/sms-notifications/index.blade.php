@extends('admin.layout.app')

@section('title', __('Sms Notifications'))

@section('breadcrumbs')
    {!! breadcrumbs([
    ['url'=>route('admin.dashboard'), 'title'=> __('Dashboard')],
    ['url'=>route('admin.sms-notifications.index'), 'title'=> __('Sms Notifications')],
]) !!}
@endsection

@section('content')

    <div class="d-flex justify-content-between">
        <h1>@lang('Email templates')</h1>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">

            <div class="table-responsive">
                <table class="table table-responsive table-striped table-sm">
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('Code')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Text')</th>
                        <th>@lang('Updated At')</th>
                        <th style="width: 120px">@lang('Actions') </th>
                    </tr>
                    </thead>
                    <tbody x-ref="sortableRef">
                    @foreach($notifications as $notification)
                        <tr>
                            <td class="handler ps-2">
                                @if($notification->exists)
                                    <i class="fa fa-circle-check text-success"></i>
                                @endif
                            </td>
                            <td>
                                {{$notification->key}}
                            </td>
                            <td>
                                {{$notification->title}}
                            </td>
                            <td>
                                {{$notification->text}}
                            </td>
                            <td>
                                {{$notification->updated_at}}
                            </td>
                            <td>
                                {{--                            <x-utils.view-button :href="route('admin.email-templates.edit', Str::replace('\\','-',$template['mailable']))" text=""/>--}}
                                {{--                            <x-utils.edit-button :href="route('admin.email-templates.edit', Str::replace('\\','-',$template['mailable']))" text=""/>--}}
                                {{--                            <x-utils.delete-button :href="route('admin.email-templates.reset', Str::replace('\\','-',$template['mailable']))" text=""/>--}}

                                <x-utils.edit-button :href="route('admin.sms-notifications.edit', $notification->key)" text=""/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-bootstrap.card>
@endsection
