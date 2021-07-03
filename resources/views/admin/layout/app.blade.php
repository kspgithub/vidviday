<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/{{config('services.tinymce.key')}}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Styles -->
    @stack('before-styles', false)
    @livewireStyles
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
    @stack('after-styles', false)
</head>
<body>

<div class="wrapper" id="app">

    @include('admin.include.sidebar')

    <div class="main">
        @include('admin.include.nav')
        <main class="content">
            <div class="container-fluid p-0">
                @include('admin.include.messages')

                @yield('content')
            </div>
        </main>
        @include('admin.include.footer')
    </div>

@include('admin.include.toast-notifications')
<!-- Scripts -->

</div>
@stack('before-scripts', false)
@livewireScripts
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="{{ mix('js/manifest.js') }}" defer></script>
<script src="{{ mix('js/vendor.js') }}" defer></script>
<script src="{{ mix('js/admin.js') }}" defer></script>
@stack('after-scripts', false)
</body>
</html>

