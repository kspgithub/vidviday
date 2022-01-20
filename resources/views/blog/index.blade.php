@extends("layout.app")

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)
@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->

            <div class="bread-crumbs">
                <a href="{{ route("home") }}">{{ __("Home") }}</a>
                <span>—</span>
                <span>{{ __("Blog") }}</span>
            </div>

            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12 news">
                    <div class="only-pad-mobile">
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="{{ __("img/preloader.png") }}" data-img-src="{{ asset("icon/filter-dark.svg") }}"
                                alt="filter-dark">@lang('tours-section.search-btn')</span>
                        <div class="spacer-xs"></div>
                    </div>
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>
                    <div class="spacer-xs"></div>
                    <div>

                        @foreach($posts as $post)


                            <div class="item post">

                                <div class="thumb-img">
                                    <img src="{{ asset("img/preloader.png") }}"
                                         data-img-src="{{ $post->main_image_url }}"
                                         alt="img 25">
                                    <a href="{{ route("blog.post", ['slug' => $post->slug]) }}"
                                       class="full-size"></a>
                                </div>
                                <div class="thumb-content">
                                    <div class="title h3">
                                        <a href="{{ route("blog.post", ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </div>
                                    <span class="text text-sm">{{ $post->created_at->format("d.m.Y") }}</span>
                                    <div class="text">
                                        <p>{{ $post->short_text }}</p>
                                        <a href="{{ route("blog.post", ['slug' => $post->slug]) }}"
                                           class="btn btn-read-more text-bold">{{ __("Read more") }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="spacer-xs"></div>

                    {{ $posts->links('paginate.vendor.pagination.default') }}

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
