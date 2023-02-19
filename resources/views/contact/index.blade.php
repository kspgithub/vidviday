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
                    <span itemprop="name">{{ $pageContent->title }}</span>
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
                    <x-tour.mobile-search-btn/>

                    <!-- BANNER/INFO -->
                    @include('contact.includes.banner')
                    <!-- BANNER/INFO END -->
                    <div class="spacer-xs"></div>
                    <!-- MAP -->
                    <div v-is="'map-route'"
                         id="map-route"
                         :lat='{{$contact->lat}}'
                         :lng='{{$contact->lng}}'
                         :address='"{{$contact->address}}"'
                         :address-comment='"{{$contact->map_comment}}"'
                    ></div>
                    <!-- MAP END -->
                    <div class="spacer-xs"></div>
                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion-all-expand">
                        <div class="expand-all-button">
                            <div class="expand-all open">{{__('common.expand-all')}}</div>
                            <div class="expand-all close">{{__('common.collapse-all')}}</div>
                        </div>
                        <div class="accordion type-4">
                            <div class="accordion-item active">
                                <div class="accordion-title">{{__('common.corporate-orders')}}<i></i></div>
                                <div class="accordion-inner" style="display: block;">
                                    <div class="thumb-wrap row">
                                        @foreach ($specCorporate as $specialist)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <x-staff.card :specialist="$specialist" :label="false"/>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(false)
                                <div class="accordion-item">
                                    <div class="accordion-title">{{__('common.agency-cooperation')}}<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="thumb-wrap row">
                                            @foreach ($specAgencies as $specialist)
                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <x-staff.card :specialist="$specialist" :label="false"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="expand-all-button">
                            <div class="expand-all open">{{__('common.expand-all')}}</div>
                            <div class="expand-all close">{{__('common.collapse-all')}}</div>
                        </div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
        <!-- SEO TEXT -->
        <x-page.regulations :model="$contact"/>
        <!-- SEO TEXT END -->
    </main>
@endsection

@push('before-scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}&libraries=places&callback=googleMapsLoaded"></script>
@endpush

@push('after-scripts')
    <script src="{{ mix('js/libs/map.js', 'assets/app') }}" defer></script>
@endpush
