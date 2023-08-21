@extends('layout.app')

@section('content')
    <main class="registration-page">
        <div class="spacer-lg"></div>
        <div class="container">
            <div class="vertical-align">
                <div>
                    <div class="img done">
                        <img loading="lazy" src="{{asset('img/preloader.png')}}" data-src="{{asset('icon/done.svg')}}" alt="done">
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <h1 class="h1"><b>{{ __('Account Deleted') }}</b></h1>
                        <div class="spacer-xs"></div>
                        <x-seo-button :code="'auth.login'" href="{{route('home')}}"
                                      class="btn type-1">{{ __('Home') }}</x-seo-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-lg"></div>
    </main>
@endsection
