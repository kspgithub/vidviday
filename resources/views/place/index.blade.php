@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">Головна</a>
                <span>—</span>
                <span>Місця</span>
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
                    <div class="banner-map">
                        <div id="map-canvas"
                             class="map-wrapper places-map full-size"
                             data-lat="49.822385"
                             data-lng="24.023855"
                             data-zoom="15"
                             data-img-cluster="{{asset('icon/cluster.svg')}}?"
                        ></div>
                        @foreach($markers as $marker)
                            <div class="marker"
                                 data-rel="map-canvas"
                                 data-title="{{$marker->title}}"
                                 data-lat="{{$marker->lat}}"
                                 data-lng="{{$marker->lng}}"
                                 data-image="{{asset('icon/marker-circle.svg')}}"
                                 data-string="<a href='{{$marker->url}}' class='info-box-title text-nowrap'>{{$marker->title}}</a>"></div>
                        @endforeach
                    </div>
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="text text-md">
                        <p>{!! $pageContent->text !!}</p>
                    </div>
                    <!-- BANNER/INFO END -->
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}"
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
                            @foreach($regions as $region)
                                <div class="accordion-item">
                                    <div class="accordion-title">{{$region->title}}<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            @foreach($region->places as $place)
                                                <div class="accordion-item">
                                                    <div class="accordion-title">{{ $place->title }}<i></i></div>
                                                    <div class="accordion-inner">
                                                        @if($place->hasMedia())
                                                            <div class="swiper-entry" v-is="'swiper-slider'"
                                                                 :media='@json($place->getMedia()->map->toSwiperSlide())'
                                                            >
                                                            </div>
                                                            <div class="spacer-xs"></div>
                                                        @endif
                                                        <div class="text text-md">
                                                            {!! $place->text !!}
                                                            <a href="{{ $place->url}}"
                                                               class="btn btn-read-more text-bold">Більше</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
        <x-page.regulations/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->
    </main>


@endsection
