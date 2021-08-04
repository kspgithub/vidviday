@extends('layout.app')

@section('content')
    <main >
        <div class="container">
            <div class="row short-distance mobile-reverse-content">
                <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">

                    <!-- BANNER CAROUSEL -->
                    @include('home.includes.banner')
                    <!-- BANNER CAROUSEL END -->

                    <!-- MOBILE BUTTONS BAR -->
                    <div class="only-pad-mobile">
                        <div class="row short-distance">
                            <div class="col-md-4 col-12 only-pad">
                                <span class="btn type-4 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</span>
                            </div>

                            <div class="col-md-4 col-12 only-pad">
                                <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/tours-scedule-dark.svg')}}" alt="tours scedule dark">Завантажити розклади турів</a>
                            </div>

                            <div class="col-md-4 col-12">
                                <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}" alt="filter-dark">Підбір туру</span>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- MOBILE BUTTONS BAR END -->

                    <div class="tabs">
                        @include('home.includes.tab-nav')
                        <div class="tabs-wrap">
                            <!-- TAB #1 -->
                            @include('home.includes.tab-gallery')
                            <!-- TAB #1 END -->

                            <!-- TAB #2 -->
                            @include('home.includes.tab-list')
                            <!-- TAB #2 END -->

                            <!-- TAB #3 -->
                            @include('home.includes.tab-calendar')
                            <!-- TAB #3 END -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-xs"></div>
        </div>

        <!-- ACHIEVEMENTS SECTION -->
        @include('home.includes.achievements')
        <!-- ACHIEVEMENTS SECTION END -->

        <!-- OUR CLIENTS -->
        @include('home.includes.partners')
        <!-- OUR CLIENTS END -->

        <!-- SEO TEXT -->
        @include('home.includes.seo-text')
        <!-- SEO TEXT END -->
    </main>

@endsection
