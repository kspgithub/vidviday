@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)


@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <span>{{$pageContent->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">

                @include('page.includes.banner-tabs', [
                   'pictures'=>$pageContent->getMedia(),
                   'video'=>$pageContent->video
               ])

                <!-- CERTIFICATE CONTENT -->
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share/>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>

                    <div class="only-pad-mobile">
                        <div class="spacer-xs"></div>
                        <a href="{{route('certificate.order')}}" class="btn type-1 btn-block btn-book-size">
                            Замовити сертифікат
                        </a>
                    </div>
                    <div class="spacer-xs"></div>

                    <!-- ACCORDIONS CONTENT -->
                    <x-faq.accordion :items="$faqItems"/>
                    <!-- ACCORDIONS CONTENT END -->
                    <!-- CERTIFICATE CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                @include('page.includes.right-sidebar', [
                    'button'=>['title'=>'Замовити сертифікат', 'url'=>route('certificate.order')],
                    'pageContent'=>$pageContent
                ])
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
    @include('home.includes.seo-text')
    <!-- SEO TEXT END -->
    </main>

@endsection

