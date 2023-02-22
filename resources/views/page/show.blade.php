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

            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1"/>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $pageContent->title }}</span>
                    <meta itemprop="position" content="2"/>
                </li>
            </ul>

            <div class="row">
                <div class="col-12 {{$pageContent->sidebar ? 'col-xl-8' : ''}}">
                    <!-- BANNER TABS -->
                    @include('page.includes.banner-tabs', [
                        'pictures'=>$pageContent->getMedia(),
                        'video'=>$pageContent->video
                    ])
                    <!-- BANNER TABS END -->
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('page.show', $pageContent->slug)"
                                             :share-title="$pageContent->title"/>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>
                    <div class="spacer-xs"></div>
                    @if($pageContent->hasMedia('gallery'))
                        <div class="swiper-entry" v-is="'swiper-slider'"
                             key="swiper-place-{{$pageContent->id}}"
                             :media='@json($pageContent->getMedia('gallery', ['published' => true])->values()->map->toSwiperSlide())'
                        >
                        </div>
                        <div class="spacer-xs"></div>
                    @endif
                </div>

                @if($pageContent->sidebar)
                    <div class="col-xl-4 col-12">
                        <!-- SIDEBAR -->
                        @include('page.includes.right-sidebar')
                        <!-- SIDEBAR END -->
                    </div>
                @endif
            </div>

            <div class="spacer-lg"></div>

            <x-page.regulations :model="$pageContent"/>
        </div>
    </main>
@endsection

