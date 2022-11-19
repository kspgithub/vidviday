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
    @livewireStyles

    <link href="{{ mix('css/main.css', 'assets/app') }}" rel="stylesheet">

    @stack('after-styles', false)

    <link href="{{mix('css/style.css', 'assets/app')}}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css', 'assets/app') }}" rel="stylesheet">
    <link href="{{ mix('css/print.css', 'assets/app') }}" media="print" rel="stylesheet">

    @production
        @if($ga = site_option('google_analytics'))
            {!! $ga !!}
        @endif
    @endproduction

</head>
<body class="{{$body_class ?? ''}}">
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
@livewireScripts

<script type="text/javascript">
    window.APP_ENV = '{{app()->environment()}}';
    window.toastsData = @json(toastData($errors));
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}&libraries=places"></script>

<script src="{{ mix('js/manifest.js', 'assets/app') }}" defer></script>
<script src="{{ mix('js/vendor.js', 'assets/app') }}" defer></script>
<script src="{{ mix('js/app.js', 'assets/app') }}" defer></script>

@stack('after-scripts', false)

@production
<div style="display: none">
    <div id="mailerlite-tourist">
        <script type="application/javascript" src="https://app.mailerlite.com/data/webforms/23099/a1x1b5.js?v12"></script>
    </div>

    <div id="mailerlite-agent">
        <script type="application/javascript" src="https://app.mailerlite.com/data/webforms/23103/h0l6i5.js?v11"></script>
    </div>
</div>
@endproduction

@production
    @if($fb = site_option('facebook_chat'))
        {!! $fb !!}
    @endif
@endproduction

</body>
</html>

