@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title"
          content="{{ !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title }}">
    <meta property="og:description"
          content="{{ !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $pageContent->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ __('Місця') }}</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ul>
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
                        <span v-bind="$buttons.tour.select" id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}"
                                alt="filter-dark">Підбір туру</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT -->

                    <div v-is="'places-accordion'" :countries="{{ json_encode($countries) }}"></div>

                    <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
        @include('includes.mobile-btns-bar')
        <!-- MOBILE BUTTONS BAR END -->
    </main>

@endsection

@push('after-scripts')
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}&libraries=places&callback=initMap"></script>
    <script defer src="{{ mix('js/libs/map.js', 'assets/app') }}"></script>
@endpush
