@extends('layout.app')

@section('content')
    <main class="registration-page">
        <div class="spacer-lg"></div>
        <div class="container">
            <div class="vertical-align">
                <div>
                    <div class="img done">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/done.svg')}}" alt="done">
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <h1 class="h1"><b>@lang('auth.registration-completed')</b></h1>
                        <span class="text-md">
                            @lang('auth.registration-details') {{$user->email}}
                        </span>
                        <div class="spacer-xs"></div>

                        @auth
                            <a v-bind="$buttons('auth.profile')" href="{{route('profile.index')}}" class="btn type-1">@lang('auth.login-profile')</a>
                        @endauth

                        @guest
                            <a v-bind="$buttons('auth.login')" href="{{route('auth.login')}}" class="btn type-1">@lang('auth.login-profile')</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-lg"></div>
    </main>
@endsection
