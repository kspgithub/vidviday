@extends("layout.app")

@section("title", !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)


@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{ route("home") }}">{{ __("Головна") }}</a>
                <span>—</span>
                <span>{{ $pageContent->title }}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-12 only-pad-mobile">
                    <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                            src="{{ __("img/preloader.png") }}" data-img-src="icon/filter-dark.svg" alt="filter-dark">{{ __("Підбір туру") }}</span>
                    <div class="spacer-xs"></div>
                </div>
                <div class="col-xl-8 col-12">
                    <!-- FAQ CONTENT -->
                    <h1 class="h1 title">{{ !empty($pageContent->seo_h1) ? $pageContent->seo_h1 : $pageContent->title }}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share/>
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
                @include("page.includes.right-sidebar")
                <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>

            <x-sidebar.filter class="only-pad-mobile"/>

        </div>

        <!-- SEO TEXT -->
        <x-page.regulations/>
        <!-- SEO TEXT END -->
    </main>

@endsection
