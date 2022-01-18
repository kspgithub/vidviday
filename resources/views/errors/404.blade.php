@extends('layout.app')


@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('home')</a>
                <span>—</span>
                <span>Сторінка не знайдена</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        <div class="left-sidebar-inner">
                            <x-sidebar.filter/>
                        </div>
                    </div>
                    <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">
                    <x-tour.mobile-search-btn/>
                    <!-- BANNER/INFO -->
                    <div class="section text-center">
                        <div class="spacer-xs"></div>
                        <span class="error">404</span>
                        <h1 class="h1 title">Нажаль, такої сторінки не існує</h1>
                        <div class="text text-md">
                            <p>Пропонуємо почати з головної сторінки</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <a href="/" class="btn type-1">На головну</a>
                        <div class="spacer-lg"></div>
                        <hr>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <!-- THUMBS CAROUSEL -->
                    <x-tour.popular/>
                    <!-- THUMBS CAROUSEL END -->


                </div>
            </div>
        </div>
    </main>

@endsection