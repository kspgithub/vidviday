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
            <ul class="bread-crumbs">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{ route('home') }}" itemprop="url">
                        <span itemprop="title">{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">@lang('Transport')</span>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('page.includes.banner-tabs', [
                   'pictures'=>$pageContent->getMedia(),
                   'video'=>$pageContent->video
               ])
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TRANSPORT CONTENT -->
                    <div class="tour-content nn">
                        <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                        <div class="spacer-xs only-desktop-9"></div>
                        <div class="only-pad-mobile">
                            <x-page.social-share  :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
                            <div class="spacer-xs"></div>
                            <span class="btn type-1 btn-block">Замовити автобус</span>
                            <div class="spacer-xs"></div>
                        </div>
                        <div class="text text-md">
                            {!! $pageContent->text !!}
                        </div>
                        <div class="spacer-xs"></div>

                        @include('transport.includes.transport')
                        @include('transport.includes.mobile-swiper')

                        <div class="spacer-xs"></div>

                        <x-page.contact-block :staff="$pageContent->staff" title="Співпраця з перевізниками"/>

                        <div class="bg-box" id="transport-form" v-is="'order-transport-form'"></div>

                    </div>
                    <!-- TRANSPORT CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('page.includes.right-sidebar', ['button'=>['title'=>'Замовити автобус', 'url'=>'#transport-form'], 'pageContent'=>$pageContent])
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
