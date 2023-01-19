@extends('admin.layout.app')
@section('content')
    <div class="dashboard d-flex justify-content-between">
        <h1>@lang('Global settings')</h1>

    </div>

    <div class="card">
        <div class="card-body">
            <form class="form mb-3" action="{{route('admin.notifications.sms')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    @foreach($notifications as $notification)

                        <div class="col-xl-6 col-lg-12">
                            <h4>{{$notification->title}}</h4>

                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">@lang('Key')</label>
                                <div class="col-md-6 mb-2">
                                    <input name="notifications[{{$notification->key}}][key]" type="text" class="form-control" disabled
                                           value="{{$notification->key}}">
                                    <input name="notifications[{{$notification->key}}][key]" type="hidden" value="{{$notification->key}}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">@lang('Title')</label>
                                <div class="col-md-6 mb-2">
                                    <input name="notifications[{{$notification->key}}][title]" type="text" class="form-control"
                                           value="{{$notification->title}}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">Доступні змінні</label>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group mb-1">
                                        @foreach($notification->replaces as $replace)
                                            <div id="notifications-{{ $notification->key }}-replace-{{ $replace }}" class="replace col-12">
                                                <span class="me-1">{{'{{'}} {{ $replace }} }}</span>
                                                <a class="copy" href="#" data-clip-copy="{{'{{'}} {{ $replace }} }}"><i data-feather="copy"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">@lang('Text')</label>
                                <div class="col-md-6 mb-2">
                                <textarea name="notifications[{{$notification->key}}][text]" rows="8"
                                          class="form-control">{!! $notification->text !!}</textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">@lang('Phone')</label>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="notifications[{{$notification->key}}][phone]" value="0">
                                        <input class="form-check-input" name="notifications[{{$notification->key}}][phone]"
                                               value="1" type="checkbox"
                                               id="notifications_{{$notification->key}}_phone"
                                            {{$notification->phone ? 'checked' : ''}}>
                                        <label class="form-check-label" for="options_{{$notification->key}}_phone"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4 col-xl-3 mb-2">@lang('Viber')</label>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="notifications[{{$notification->key}}][viber]" value="0">
                                        <input class="form-check-input" name="notifications[{{$notification->key}}][viber]"
                                               value="1" type="checkbox"
                                               id="events_{{$notification->key}}_viber"
                                            {{$notification->viber ? 'checked' : ''}}>
                                        <label class="form-check-label" for="options_{{$notification->key}}_viber"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection
