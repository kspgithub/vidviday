@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title }}">
    <meta property="og:description" content="{{ !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title }}">
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
                <div class="col-xl-8 col-12">
                    @include('page.includes.banner-tabs', [
                            'pictures'=>$pageContent->getMedia(),
                            'video'=>$pageContent->video
                        ])
                    <div class="spacer-xs"></div>
                    <!-- CORPORATE CONTENT -->
                    <div class="tour-content">
                        <h1 class="h1 title autoheight">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                        <div class="spacer-xs"></div>
                        <div class="only-pad-mobile">
                            <x-page.social-share  :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
                        </div>
                        <div class="text text-md">
                            <p>{!! $pageContent->text !!}</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="only-pad-mobile">
                        <a class="btn type-1 btn-block btn-book-size"
                            href="{{ Auth::check() ? (Auth::user()->isTourAgent() ? route('profile.index') : route('auth.register', ['tour_agent' => 1])) : route('auth.register', ['tour_agent' => 1]) }}"
                        >{{__('tours-section.start-cooperation')}}</a>
                            <div class="spacer-xs"></div>
                        </div>
                        <!-- ACCORDIONS CONTENT -->
                        <x-faq.accordion :items="$faqItems"/>
                        <!-- ACCORDIONS CONTENT END -->
                    </div>
                    <!-- CORPORATE CONTENT END -->
                    <div class="spacer-xs only-pad-mobile"></div>
                    <a class="btn font-lg type-1 btn-block btn-book-size  only-pad-mobile no-print"
                       href="{{ Auth::check() ? (Auth::user()->isTourAgent() ? route('profile.index') : route('auth.register', ['tour_agent' => 1])) : route('auth.register', ['tour_agent' => 1]) }}"
                    >{{__('tours-section.start-cooperation')}}</a>
                </div>
                <div class="col-xl-4 col-12">
                    <!-- THUMBS CAROUSEL -->
                    <div class="section only-pad-mobile no-print">
                    @include('corporate.includes.carousel')
                    <!-- THUMBS CAROUSEL END -->
                    </div>
                    @include('page.includes.right-sidebar', [
                        'button' => [
                            'title' => __('tours-section.start-cooperation'),
                            'url' => Auth::check() ?
                            (Auth::user()->isTourAgent() ? route('profile.index') : route('auth.register', ['tour_agent' => 1]))
                            : route('auth.register', ['tour_agent' => 1]),
                            'logout' => Auth::check() && !Auth::user()->isTourAgent(),
                        ],
                        'pageContent' => $pageContent
                    ])
                </div>
            </div>
            <!-- THUMBS CAROUSEL -->
            <div class="section only-desktop only no-print">
                @include('corporate.includes.carousel')
            </div>
            <!-- THUMBS CAROUSEL END -->
            <div class="spacer-lg"></div>
        </div>


        <!-- OUR CLIENTS -->
        <x-page.clients/>
        <!-- OUR CLIENTS END -->

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>
@endsection
