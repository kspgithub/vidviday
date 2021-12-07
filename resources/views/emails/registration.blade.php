@extends('emails.layout')


@section('content')
    <div class="body">
        <div style="text-align: center;">
            <span class="title">@lang('Hi'), {{$user->name}}!</span>
        </div>
        <!-- TABLE -->
        <div class="card">
            <div style="padding: 15px 20px 30px; border-bottom: 1px solid #E9E9E9;">
                <p>Дякуємо за реєстрацію на сайті <a href="{{url('/')}}">vidviday.ua</a>.</p>
                <div style="font-weight: 500; font-size: 20px; margin: 30px 0 5px;">Ваші реєстраційні данні</div>
                <div style="margin-bottom: 5px;">
                    @lang('First Name'): <b style="color: #323232">{{$user->first_name}}</b>
                </div>
                <div style="margin-bottom: 5px;">
                    @lang('Last Name'): <b style="color: #323232">{{$user->last_name}}</b>
                </div>
                @if(!empty($user->middle_name))
                    <div style="margin-bottom: 5px;">
                        @lang('Middle Name'): <b style="color: #323232">{{$user->middle_name}}</b>
                    </div>
                @endif
                <div style="margin-bottom: 5px;">
                    Email: <b style="color: #323232">{{$user->email}}</b>
                </div>
                <div style="margin-bottom: 5px;">
                    Пароль: <b style="color: #323232">{{$password}}</b>
                </div>
                @if(!empty($user->mobile_phone))
                    <div style="margin-bottom: 5px;">
                        @lang('Phone'): <b style="color: #323232">{{$user->mobile_phone}}</b>
                    </div>
                @endif
                @if(!empty($user->viber))
                    <div style="margin-bottom: 5px;">
                        @lang('Viber'): <b style="color: #323232">{{$user->viber}}</b>
                    </div>
                @endif
            </div>
            @if($user->isTourAgent())
                <div style="padding: 15px 20px 30px; border-bottom: 1px solid #E9E9E9;">
                    <div style="font-weight: 500; font-size: 20px; margin: 30px 0 5px;">Інформація про турфірму</div>
                    <div style="margin-bottom: 5px;">
                        Назва турфірми: <b style="color: #323232">{{$user->company}}</b>
                    </div>
                    @if(!empty($user->address))
                        <div style="margin-bottom: 5px;">
                            Адреса офісу: <b style="color: #323232">{{$user->address}}</b>
                        </div>
                    @endif
                    @if(!empty($user->position))
                        <div style="margin-bottom: 5px;">
                            Посада: <b style="color: #323232">{{$user->position}}</b>
                        </div>
                    @endif
                    @if(!empty($user->website))
                        <div style="margin-bottom: 5px;">
                            Адреса веб-сторінки: <b style="color: #323232">{{$user->website}}</b>
                        </div>
                    @endif
                    @if(!empty($user->work_email))
                        <div style="margin-bottom: 5px;">
                            Електронна пошта фірми: <b style="color: #323232">{{$user->work_email}}</b>
                        </div>
                    @endif
                    @if(!empty($user->work_phone))
                        <div style="margin-bottom: 5px;">
                            Робочий телефон: <b style="color: #323232">{{$user->work_phone}}</b>
                        </div>
                    @endif
                </div>
            @endif
            <div style="padding: 30px 20px; text-align: center;">
                <a href="{{url('/')}}" class="btn">Перейти на сайт</a>
            </div>
        </div>

    </div>
    <!-- TABLE END -->


@endsection
