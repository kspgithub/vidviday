@extends('emails.layout')


@section('content')
    <div>
        <div style="text-align: center;">
            <x-email.title>Реєстрація {{$user->isTourAgent() ? 'турагента':'користувача'}}</x-email.title>
        </div>
        <x-email.card>
            <p>
                Нова реєстрація {{$user->isTourAgent() ? 'турагента':'користувача'}} на сайті
                <a href="{{asset('/')}}">vidviday.ua</a>.
            </p>
            <div style="font-weight: 500; font-size: 20px; margin: 30px 0 5px;">Реєстраційні данні</div>
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

            @if($user->isTourAgent())
                <hr style="margin: 15px 0">
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
            @endif
            <hr style="margin: 15px 0">

            <div style="padding: 30px 20px; text-align: center;">
                <x-email.btn href="{{asset('/')}}">Перейти на сайт</x-email.btn>
            </div>
        </x-email.card>

    </div>
    <!-- TABLE END -->


@endsection
