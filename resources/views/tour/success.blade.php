@extends('layout.app')
@section('title', 'Замовлення туру')
@section('content')
    <main class="order-page">
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
                    <div class="only-pad-mobile">
                        <x-seo-button key="tour.select" class="btn type-5 arrow-right text-left flex"><img
                                src="/img/preloader.png" data-img-src="{{ asset('icon/filter-dark.svg') }}"
                                alt="filter-dark">Підбір туру</x-seo-button>
                    </div>
                    <div class="spacer-xs"></div>
                    <!-- ORDER COMPLETE CONTENT -->
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 col-12">
                            <div class="img done">
                                <img src="/img/preloader.png" data-img-src="/icon/done.svg" alt="done">
                            </div>
                            <div class="spacer-xs"></div>
                            <h1 class="h2 text-center">Ми отримали Ваше замовлення</h1>
                            <div class="text text-center">
                                <p>
                                    Success
                                </p>
                            </div>
                            <div class="spacer-xs"></div>

                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <span class="text">Дякуємо, що обрали нас!</span>
                                <div class="spacer-xs"></div>
                                <x-seo-button key="goto.home" href="/" class="btn type-1">На головну</x-seo-button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER COMPLETE CONTENT END -->
                    <div class="spacer-lg"></div>
                    <hr>
                    <div class="spacer-sm"></div>
                    <!-- THUMBS CAROUSEL -->
                    <x-tour.popular/>
                    <!-- THUMBS CAROUSEL END -->
                </div>
            </div>
            <div class="spacer-md"></div>
        </div>
    </main>

@endsection
