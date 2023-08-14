<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    @if(!allowIndex())
        <meta name="robots" content="noindex,follow">
    @endif

    <title>@yield('title', config('app.name', 'Vidviday'))</title>
    <meta name="keywords" content="@yield('seo_keywords', config('app.name', 'Vidviday'))">
    <meta name="description" content="@yield('seo_description',  config('app.name', 'Vidviday'))">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}"/>

    @foreach($localeLinks ?? [] as $locale => $link)
        <link rel="alternate" hreflang="{{ $locale }}-UA" href="{{ url($link) }}"/>
    @endforeach

    @stack('meta-fields', false)

    @include('layout.includes.grid')
    <!-- Styles -->
    @stack('before-styles', false)

    <link href="{{ mix('css/theme/main.css', 'assets/app') }}" rel="stylesheet">

    @stack('after-styles', false)

    <link href="{{mix('css/theme/style.css', 'assets/app')}}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css', 'assets/app') }}" rel="stylesheet">
    <link href="{{ mix('css/theme/print.css', 'assets/app') }}" media="print" rel="stylesheet">

    @if($head = site_option('head'))
        {!! $head !!}
    @endif

    @if(is_tour_agent())
        <style>
            @page {
                size: auto;
                margin: 0mm;
            }
        </style>
    @endif
</head>
<body class="{{$body_class ?? ''}} {{  $bodyClass ?? '' }} @if(is_tour_agent()) agent-print @endif">

@if($bodyTop = site_option('body_top'))
    {!! $bodyTop !!}
@endif

<div id="app">
    <!-- LOADER -->
    <div id="loader"></div>

    <!-- HEADER -->
    <div id="header-layer-close"></div>
    <x-site-header :locale-links="$localeLinks ?? []"/>
    <!-- END HEADER -->

    @yield('content')

    <!-- FOOTER -->
    <div id="footer-layer-close"></div>
    <x-site-footer/>
    <!-- END FOOTER -->
    <div v-is="'mobile-search'"></div>
    <!-- BUTTON SCROLL TO TOP -->
    <div class="btn-to-top"></div>

    @include('includes.popups')

    @include('layout.includes.toast-notifications')
</div>

@stack('before-scripts', false)

<script type="text/javascript">
    window.APP_ENV = '{{app()->environment()}}'
    window.countries = @json(App\Models\Country::query()->where('published', 1)->orderBy('position')->orderBy('title')->pluck('iso'));
    window.popupMessages = @json(App\Models\PopupMessage::query()->get()->translate()->keyBy('type'));
    window.popupData = @json(popupData($errors));
    window.toastsData = @json(toastData($errors));
    window.initMap = () => {
        window.dispatchEvent(new CustomEvent('googleMapsLoaded'))
    }
    window.seoButtons = @json(app('seo-buttons')->all());
</script>

<script src="{{ mix('js/libs/manifest.js', 'assets/app') }}" defer></script>
<script src="{{ mix('js/libs/vendor.js', 'assets/app') }}" defer></script>
<script src="{{ mix('js/app.js', 'assets/app') }}" defer></script>

@stack('after-scripts', false)

@production
    <div style="display: none">
        <div id="mailerlite-tourist">
            <script type="application/javascript"
                    src="https://app.mailerlite.com/data/webforms/23099/a1x1b5.js?v12"></script>
        </div>

        <div id="mailerlite-agent">
            <script type="application/javascript"
                    src="https://app.mailerlite.com/data/webforms/23103/h0l6i5.js?v11"></script>
        </div>
    </div>
@endproduction

@guest
    @if(config('services.google.autologin'))
        <script src="https://accounts.google.com/gsi/client" async defer></script>
        <div id="g_id_onload"
             data-client_id="{{ config('services.google.client_id') }}"
             data-login_uri="{{ route('auth.social.verify', 'google') }}"
             data-itp_support="false"
             data-auto_select="false"
             data-auto_prompt="true"
        >
        </div>
    @endif
@endguest

@if($bodyBottom = site_option('body_bottom'))
    {!! $bodyBottom !!}
@endif

</body>
</html>

