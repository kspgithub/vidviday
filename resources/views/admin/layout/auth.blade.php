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

    <!-- Styles -->
    @stack('before-styles', false)
    @livewireStyles
    <link href="{{ mix('css/admin.css', 'assets/admin') }}" rel="stylesheet">
    @stack('after-styles', false)
</head>
<body>
<main class="d-flex w-100" id="app">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    @include('admin.include.messages')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Scripts -->
@stack('before-scripts', false)
@livewireScripts
<script src="{{ mix('js/manifest.js', 'assets/admin') }}" defer></script>
<script src="{{ mix('js/vendor.js', 'assets/admin') }}" defer></script>
<script src="{{ mix('js/admin.js', 'assets/admin') }}" defer></script>
@stack('after-scripts', false)
</body>
</html>

