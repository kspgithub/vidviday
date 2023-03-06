@extends('layout.app')

@section('title', !empty($place->seo_title) ? $place->seo_title : $place->title)
@section('seo_description', !empty($place->seo_description) ? $place->seo_description : $place->title)
@section('seo_keywords', !empty($place->seo_keywords) ? $place->seo_keywords : $place->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($place->seo_title) ? $place->seo_title : $place->title }}">
    <meta property="og:description"
          content="{{ !empty($place->seo_description) ? $place->seo_description : $place->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $place->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
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
                    <a href="{{ route('places') }}" itemprop="item">
                        <span itemprop="name">{{ __("Місця") }}</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $place->title }}</span>
                    <meta itemprop="position" content="3" />
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
                    <div class="section">
                        <!-- BANNER TABS -->

                        @include('place.includes.banner-tabs', [
                            'pictures'=>$place->getMedia(),
                            'place'=>$place,
                        ])
                        <!-- BANNER TABS END -->
                        <div class="spacer-xs"></div>
                        <div class="row">
                            <div class="col-xl-8 col-12">
                                <h1 class="h1 title">{{ $place->title }}</h1>
                                <div class="spacer-xs"></div>
                                <x-tour.star-rating :rating="$place->testimonials_avg_rating" :count="$place->testimonials_count"/>

                                <div class="spacer-xs"></div>
                                <x-sidebar.social-share :share-url="$place->url" :share-title="$place->title"
                                                        class="only-pad-mobile inline-block"/>
                                <div class="seo-text load-more-wrapp">

                                    <div class="less-info">
                                        <div class="text text-md">
                                            {{str_limit(strip_tags(html_entity_decode($place->text)), 300, '...')}}
                                        </div>
                                    </div>
                                    <div class="more-info">
                                        <div class="text text-md">
                                            {!! $place->text !!}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="spacer-xs"></div>
                                        <div class="show-more">
                                            <span>@lang('tours-section.read-more')</span>
                                            <span>@lang('tours-section.hide-text')</span>
                                        </div>
                                        <div class="spacer-xs"></div>
                                    </div>
                                </div>
                            </div>

                            @include('place.includes.right-block')
                        </div>
                    </div>

                    <div class=" hidden-print">
                        <!-- BANNER/INFO END -->
                        <div class="only-pad-mobile">
                            <div class="spacer-xs"></div>
                            <x-seo-button :code="'tour.select'" class="btn type-5 arrow-right text-left flex"><img
                                    src="{{asset('img/preloader.png')}}"
                                    data-src="{{asset('icon/filter-dark.svg')}}"
                                    alt="filter-dark">Підбір туру</x-seo-button>
                            <div class="spacer-xs"></div>
                        </div>
                        <div class="spacer-xs"></div>
                        <h2 class="h2  hidden-print">Ми підібрали тури в які входить це місце:</h2>
                        <div class="spacer-xs"></div>
                        <hr>
                        <div class="spacer-xs"></div>

                        <tour-search v-is="'tour-search'" :place="{{ json_encode($place) }}" show-title :in-future="false">
                            @if($tours->count() > 0)
                                <!-- MOBILE BUTTONS BAR -->
                                @include('includes.mobile-btns-bar')
                                <!-- MOBILE BUTTONS BAR END -->
                                <div class="text text-lg" v-is="'tour-request-title'">
                                    <p>
                                        @lang('tours-section.found')
                                        <b class="text-bold">
                                            {{$tours->total()}} {{plural_form($tours->total(), [
                                     __('tours-section.one_tour'),
                                     __('tours-section.two_tours'),
                                     __('tours-section.many_tours')
                                    ])}}
                                        </b>
                                        @if(!empty($request_title))
                                            @lang('tours-section.on_request')
                                            <b class="text-bold">{{urldecode($request_title)}}</b>
                                        @endif
                                    </p>
                                </div>
                                <div class="spacer-xs"></div>
                                <hr>
                                <div class="spacer-xs"></div>


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
                            @else
                                <div class="only-pad-mobile">
                            <x-seo-button :code="'tour.select'" class="btn type-5 arrow-right text-left flex">
                                <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                                     data-src="{{asset('/icon/filter-dark.svg')}}" alt="filter-dark">
                                @lang('tours-section.search-btn')
                            </x-seo-button>
                                    <div class="spacer-xs"></div>
                                </div>
                                <div class="section text-center">
                                    <div class="spacer-xs"></div>
                                    <h1 class="h1 title">@lang('tours-section.empty-results')</h1>
                                    <div class="text text-md">
                                        <p>@lang('tours-section.empty-proposal')</p>
                                    </div>
                                    <div class="spacer-xs"></div>
                                    <x-seo-button :code="'goto.home'" href="{{route('home')}}" class="btn type-1">@lang('tours-section.go-home')</x-seo-button>
                                    <div class="spacer-lg"></div>
                                    <hr>
                                    <div class="spacer-xs"></div>
                                </div>
                                <x-tour.popular/>
                            @endif
                        </tour-search>

                        <!-- ACCORDIONS CONTENT -->
                        @include('place.includes.testimonials')
                        <!-- ACCORDIONS CONTENT END -->
                    </div>

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$place"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
        @include('includes.mobile-btns-bar')
        <!-- MOBILE BUTTONS BAR END -->

    </main>

@endsection

@push('after-popups')
    <div v-is="'place-testimonial-form'"
         :place='@json($place->shortInfo())'
         :user='@json(current_user())'
         action='{{route('place.testimonial', $place)}}'
         :data-parent="0"
         :tours='@json($place->tours->map->shortInfo())'
    >
        @csrf
    </div>

@endpush

@push('after-scripts')
    <script src="{{ mix('js/libs/map.js', 'assets/app') }}"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}&libraries=places&callback=initMap"></script>
@endpush
