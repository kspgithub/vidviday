@extends('layout.app')

@section('title', !empty($event->seo_title) ? $event->seo_title : $event->title)
@section('seo_description', !empty($event->seo_description) ? $event->seo_description : $event->title)
@section('seo_keywords', !empty($event->seo_keywords) ? $event->seo_keywords : $event->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($event->seo_title) ? $event->seo_title : $event->title }}">
    <meta property="og:description"
          content="{{ !empty($event->seo_description) ? $event->seo_description : $event->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $event->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
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
                    <a href="{{ pageUrlByKey('events') }}" itemprop="item">
                        <span itemprop="name">{{ __("Events") }}</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $event->title }}</span>
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
                    @include('page.includes.banner-tabs', [
                           'pictures'=>$event->getMedia(),
                           'video'=>$event->video
                       ])
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{!empty($event->seo_h1) ?$event->seo_h1 : $event->title}}</h1>
                    <div class="text text-md">
                        {!! $event->text !!}
                    </div>

                    <div class="spacer-xs"></div>
                    <x-tour.mobile-search-btn/>

                    @if($tours->count())
                        @include('event.tours', ['tours' => $tours])
                    @endif
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$event"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
        @include('includes.mobile-btns-bar')
        <!-- MOBILE BUTTONS BAR END -->
    </main>
@endsection
