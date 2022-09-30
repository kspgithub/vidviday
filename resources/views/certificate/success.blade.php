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
    @if($pageImage = $pageContent->getFirstMedia() ?: AppModelsPage::where('key', 'home')->first()?->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@section('content')
    <main class="order-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        <div class="left-sidebar-inner">
                            <x-sidebar.filter/>

                            <x-sidebar.mailing/>
                        </div>
                    </div>
                    <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">
                    <x-tour.mobile-search-btn/>

                    <!-- ORDER COMPLETE CONTENT -->
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 col-12">
                            <div class="img done">
                                <img src="/img/preloader.png" data-img-src="/icon/done.svg" alt="done">
                            </div>
                            <div class="spacer-xs"></div>
                            <h1 class="h2 text-center">@lang('order-section.certificate.success')</h1>
                            <div class="spacer-xs"></div>
                            @include('certificate.includes.box', ['order'=>$order])
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <span
                                    class="text-md">{{__('order-section.details-message')}} <b>{{$order->email}}</b></span>
                                <div class="spacer-xs"></div>
                                <a href="{{pageUrlByKey('certificate')}}"
                                   class="btn type-1">{{__('order-section.certificate.go-to-description')}}</a>
                            </div>
                        </div>
                    </div>
                    <!-- ORDER COMPLETE CONTENT END -->

                    <div class="spacer-lg"></div>
                    <hr>
                    <div class="spacer-sm"></div>
                    <x-page.social-links/>
                    <div class="spacer-sm"></div>
                    <hr>
                    <div class="spacer-sm"></div>
                    <!-- THUMBS CAROUSEL -->
                    <x-tour.popular/>
                    <!-- THUMBS CAROUSEL END -->
                </div>
            </div>
            <div class="spacer-md"></div>
        </div>
    </main>

@endsection

