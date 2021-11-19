@extends('layout.app')


@section('content')
    <main>
        <div class="container">
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
                        <span class="error">401</span>
                        <h1 class="h1 title">Нажаль, вам не можна тут знаходитися</h1>
                        <div class="text text-md">
                            <p>Пропонуємо повернутися на головну сторінку</p>
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
