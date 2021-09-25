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
                        <div class="social">
                            <span>Поділитись:</span>
                            <div class="share dropdown">
                                <div class="icon">
                                    <div class="dropdown-btn full-size"></div>
                                </div>
                                <div class="dropdown-toggle">
                                    <div class="social style-1">
                                        <a href="https://www.facebook.com/vidviday">
                                            <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z" fill="#4267B2"/></svg>
                                        </a>

                                        <a href="https://twitter.com/vidviday">
                                            <svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z" fill="#179CDE"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <div class="accordion-all-expand">
                                        <div class="expand-all-button">
                                            <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                            <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                        </div>

                                        <div class="accordion type-5">

                                            @foreach($faqGroup->items as $skey=>$item)
                                                <div class="accordion-item {{$loop->iteration == 1 ? 'active' : ''}}">
                                                    <div class="accordion-title">
                                                        <b>{{ $loop->iteration > 9 ? $loop->iteration : "0".$loop->iteration }}
                                                            .</b>
                                                        {{ $item->question }}<i></i>
                                                    </div>
                                                    <div class="accordion-inner"
                                                        {!! $loop->iteration == 1 ? 'style="display: block;"' : '' !!}>
                                                        <div class="text text-md">
                                                            <p> {{ $item->answer }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="expand-all-button">
                                            <div class="expand-all open">{{ __("Розгорнути все") }}</div>
                                            <div class="expand-all close">{{ __("Згорнути все") }}</div>
                                        </div>
                                    </div>
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
    @include("home.includes.seo-text")
        <!-- SEO TEXT END -->
    </main>

@endsection
