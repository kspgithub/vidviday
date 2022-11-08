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
                    <span itemprop="title">{{ $pageContent->title }}</span>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- DOCUMENTS CONTENT -->
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        <p>{!! $pageContent->text !!}</p>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="thumb-wrap row">
                        @foreach ($documents as $document)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="bordered-box doc">
                                    <a class="img d-block open-popup" data-rel="document-popup" href="{{$document->file}}" target="_blank">
                                        <img loading="lazy"
                                             src="{{asset('img/preloader.png')}}"
                                             data-img-src="{{$document->image ?? asset('img/no-image.png')}}"
                                             alt="{{$document->title}}">
                                    </a>
                                    <span class="text text-medium">{{$document->title}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- DOCUMENTS CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :pageContent="$pageContent">

                    </x-page.right-sidebar>
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

@push('popups')
    <div class="popup-content" data-rel="document-popup">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="btn-close">
                <span></span>
            </div>
            <div class="content" style="height: 70vh; padding-top: 50px"></div>
        </div>
    </div>
@endpush

@push('after-scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            $('.open-popup[data-rel="document-popup"]').click(function (e) {
                let url = $(this).attr('href')
                let frame = '<iframe src="'+url+'" frameborder="0" height="100%" width="100%"></iframe>'
                $('.popup-content[data-rel="document-popup"] .content').html(frame)
            })
        })
    </script>
@endpush
