@extends('layout.app')
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{'/'}}">Головна</a>
                <span>—</span>
                <a href="{{route('places')}}">Місця</a>
                <span>—</span>
                <span>{{ $places->title }}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <!-- BANNER/INFO -->
                @include('place.includes.banner-place')
                <!-- BANNER/INFO END -->
                    <div class="only-pad-mobile">
                        <div class="spacer-xs"></div>
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}"
                                alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="spacer-xs"></div>
                    <h2 class="h2">Ми підібрали тури в які входить це місце:</h2>
                    <div class="spacer-xs"></div>
                    <hr>
                    <div class="spacer-xs"></div>
                    <div class="tabs">
                        <div class="tab-nav">
                            <ul class="tab-toggle">
                                <li class="tab-caption active">
                                    <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V1zM8 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V9zM0 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V9zM0 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V1z"/>
                                    </svg>
                                    <span>Галерея</span>
                                </li>

                                <li class="tab-caption only-desktop">
                                    <svg width="16" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 1a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 1a1 1 0 112 0 1 1 0 01-2 0zM4 6a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 6a1 1 0 112 0 1 1 0 01-2 0zM4 11a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 11a1 1 0 112 0 1 1 0 01-2 0z"/>
                                    </svg>
                                    <span>Список</span>
                                </li>

                                <li class="tab-caption calendar-init">
                                    <svg width="15" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x=".75" y="2.75" width="13.5" height="13.5" rx="1.25" stroke-width="1.5"/>
                                        <path
                                            d="M3 8h2v2H3V8zM6.5 8h2v2h-2V8zM10 8h2v2h-2V8zM3 12h2v2H3v-2zM6.5 12h2v2h-2v-2zM10 12h2v2h-2v-2zM3.25 2.5a.75.75 0 001.5 0h-1.5zM4.75 1a.75.75 0 00-1.5 0h1.5zm5.5 1.5a.75.75 0 001.5 0h-1.5zm1.5-1.5a.75.75 0 00-1.5 0h1.5zM0 6.75h15v-1.5H0v1.5zM4.75 2.5V1h-1.5v1.5h1.5zm7 0V1h-1.5v1.5h1.5z"/>
                                    </svg>
                                    <span>Календар</span>
                                </li>
                            </ul>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="tabs-wrap">
                            <!-- TAB #1 -->

                            <!-- TAB #1 END -->
                        @include('home.includes.tab-gallery')
                        <!-- TAB #2 -->
                        @include('home.includes.tab-calendar')
                        <!-- TAB #2 END -->

                            <!-- TAB #3 -->
                        @include('home.includes.tab-list')
                        <!-- TAB #3 END -->
                        </div>
                    </div>

                    <!-- ACCORDIONS CONTENT -->
                @include('place.includes.response')
                <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->

    </main>

@endsection
