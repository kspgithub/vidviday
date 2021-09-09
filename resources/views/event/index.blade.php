@extends('layout.app')
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="index.php">Головна</a>
                <span>—</span>
                <span>Події</span>
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
                @include('event.includes.banner')
                <!-- BANNER/INFO END -->
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="icon/filter-dark.svg"
                                alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion-all-expand inner-not-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>

                        <div class="accordion type-4 accordions-inner-wrap">
                            @foreach ($eventsItems as  $eventsItem)
                                <div class="accordion-item">
                                    <div class="accordion-title">{{$eventsItem->group->title}}<i></i></div>

                                    <div class="accordion-inner">

                                        <div class="accordion type-2">
                                            <div class="accordion-item">

                                                <div class="accordion-title">{{$eventsItem->title}}<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        @include('event.includes.events-coruosel')
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text text-md">
                                                        {{$eventsItem->text}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="expand-all-button">
                            <div class="expand-all open">Розгорнути все</div>
                            <div class="expand-all close">Згорнути все</div>
                        </div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('place.includes.seo-text')
    <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->
    </main>
@endsection
