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

@include('layout.includes.grid')
<!-- Styles -->
    @stack('before-styles', false)
    @livewireStyles
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">

    @stack('after-styles', false)
</head>
<body class="{{$body_class ?? ''}}">
<div id="app">
    <!-- LOADER -->
    <div id="loader"></div>

    <!-- HEADER -->
    <div id="header-layer-close"></div>
    <x-site-header/>

@yield('content')
    <!-- FOOTER -->
    <div id="footer-layer-close"></div>
    <x-site-footer/>

@include('includes.search-dropdown')

<!-- BUTTON SCROLL TO TOP -->
    <div class="btn-to-top"></div>

    @include('includes.popups')

    @include('includes.video')

    <div class="toast-container"></div>
</div>

<link href="{{mix('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

@stack('before-scripts', false)
@livewireScripts
<script src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}"></script>
<script src="{{ mix('js/manifest.js') }}" defer></script>
<script src="{{ mix('js/vendor.js') }}" defer></script>

<script src="{{ mix('js/app.js') }}" defer></script>
@stack('after-scripts', false)

</body>
</html>

