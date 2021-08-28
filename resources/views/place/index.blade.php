@extends('layout.app')
@section('title')
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
                        @foreach($badges as $badge)
                            <span
                                style="position: absolute;top:30%;left:50%;background-color:{{$badge->color}};width:20px;height:20px;"></span>
                            <div id="map-canvas" class="map-wrapper full-size" data-lat="49.822385" data-lng="24.023855"
                                 data-zoom="15" data-img-cluster="{{asset('img/cluster.png')}}"></div>
                            <a class="marker" data-rel="map-canvas-1" data-lat="49.822385" data-lng="24.023855"
                               data-image="{{asset('img/marker.png')}}"
                               data-string="<h5>Головний офіс</h5><p>Україна, 79018, м. Львів, вул. Вулиця, 555</p>"></a>
                        @endforeach
                    </div>
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">Місця</h1>
                    <div class="text text-md">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tempore nesciunt deleniti.
                            Nisi explicabo provident ipsum sapiente, temporibus sed error!Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit. Repudiandae repellendus nam eum quia explicabo
                            perspiciatis!</p>
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

                            <div class="accordion-item">
                                @foreach($places as $place)
                                    <div class="accordion-title">{{$place->region->title}}<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">{{$place->city->title}}<i></i></div>
                                                <div class="accordion-inner">
                                                    @include('place.includes.city-carousel')
                                                    <div class="spacer-xs"></div>
                                                    <div class="text text-md">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-title">{{ $place->title }}<i></i></div>
                                                <div class="accordion-inner">
                                                    @include('place.includes.place-carousel')
                                                    <div class="spacer-xs"></div>
                                                    <div class="text text-md">
                                                        {!! $place->text !!}
                                                        <a href="{{route('place', $place->slug)}}"
                                                           class="btn btn-read-more text-bold">Більше</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
