@extends('layout.app')

@section('content')
    <main class="registration-page">
        <div class="spacer-lg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-5">
                    <div class="text-center">
                        <span class="h2 title text-medium">@lang('auth.login-title')</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form action="{{route('auth.login.store')}}" method="POST">
                        @csrf
                        <label data-tooltip="@lang('forms.required')">
                            <i>@lang('forms.email')*</i>
                            <input type="text" name="email" required>
                        </label>
                        <label data-tooltip="@lang('forms.required')">
                            <i>@lang('forms.password')*</i>
                            <input type="password" name="password" required autocomplete="off">
                        </label>
                        <div class="text text-sm">@lang('auth.required-fields')</div>
                        <div class="spacer-xs"></div>
                        <span class="text open-popup"
                              data-rel="password-recovery-popup">@lang('auth.forgot-password')</span>
                        <div class="spacer-xs"></div>

                        <x-seo-button :code="'auth.login'" type="submit" class="btn type-1 btn-block">
                            {{ __('auth.sign-in') }}
                        </x-seo-button>

                        <div class="spacer-xs"></div>
                        <div class="text-center">
                            <div class="text">або</div>
                        </div>
                        <div class="spacer-xs"></div>
                        <x-seo-button :code="'auth.login_facebook'" href="{{route('auth.social.login', 'facebook')}}"
                                      class="btn type-1 btn-block btn-fb">
                            <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z"/>
                            </svg>
                            {{ __('auth.sign-in-with', ['provider' => 'Facebook']) }}
                        </x-seo-button>
                        <div class="spacer-xs"></div>
                        <x-seo-button :code="'auth.login_google'" href="{{route('auth.social.login', 'google')}}"
                                      class="btn type-1 btn-block btn-google">
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 6.4v3.2h4.526A4.81 4.81 0 018 12.8 4.806 4.806 0 013.2 8c0-2.646 2.154-4.8 4.8-4.8 1.147 0 2.251.411 3.109 1.158l2.102-2.412A7.928 7.928 0 008 0C3.589 0 0 3.589 0 8s3.589 8 8 8 8-3.589 8-8V6.4H8z"/>
                            </svg>
                            {{ __('auth.sign-in-with', ['provider' => 'Google']) }}
                        </x-seo-button>
                    </form>
                    <div class="spacer-xs"></div>

                </div>
                <div class="spacer-xs"></div>
                <div></div>
            </div>
        </div>
        <div class="spacer-xs"></div>
        <div class="text-center">
            <span class="text">@lang('auth.not-have-account') <a
                    href="{{route('auth.register')}}">@lang('auth.registration') </a></span>
        </div>
        <div class="spacer-lg"></div>
    </main>

@endsection
