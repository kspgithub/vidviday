@extends("layout.app")

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

@section("content")

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
                <div class="col-12 only-pad-mobile">
                    <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                            src="{{ asset("img/preloader.png") }}" data-img-src="{{ asset('icon/filter-dark.svg') }}" alt="filter-dark">{{ __("Підбір туру") }}</span>
                    <div class="spacer-xs"></div>
                </div>
                <div class="col-xl-8 col-12">
                    <!-- FAQ CONTENT -->
                    <h1 class="h1 title">{{ !empty($pageContent->seo_h1) ? $pageContent->seo_h1 : $pageContent->title }}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share :share-url="route('page.show', $pageContent->slug)" :share-title="$pageContent->title"/>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>
                    <div class="spacer-xs"></div>
                    <hr>
                    <div class="spacer-xs"></div>

                    <div class="tabs faqs">
                        <div class="tab-nav faq-tab-nav">
                            <ul class="tab-toggle">
                                @foreach($faqGroups as $faqGroup)
                                    <li class="tab-caption {{$loop->first ? 'active' : ''}}">
                                        <span>{{ $faqGroup->title }}</span>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="tabs-wrap">
                            @foreach($faqGroups as $key=>$faqGroup)
                                <div class="tab {{$key === 0 ? 'active' : ''}}">
                                    <x-faq.accordion :items="$faqGroup->items"/>
                                </div>
                                <!-- TAB #1 END -->
                            @endforeach

                        </div>
                    </div>
                    <!-- FAQ CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :page-content="$pageContent"></x-page.right-sidebar>

                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>

            <x-sidebar.filter class="only-pad-mobile"/>

        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent ?? null"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
