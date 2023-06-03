@extends("layout.app")

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

@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->

            @include("news.includes.bread_crumbs")

            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    @include('includes.sidebar')
                    <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12 news">

                    <div class="only-pad-mobile">
                        <x-seo-button :code="'tour.select'" class="btn type-5 arrow-right text-left flex">
                            <img loading="lazy" src="/img/preloader.png" data-src="{{ asset('icon/filter-dark.svg') }}"
                                 alt="filter-dark">
                            Підбір туру
                        </x-seo-button>
                            <div class="spacer-xs"></div>
                    </div>

                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>

                    <div class="spacer-xs"></div>

                    <div>

                        @foreach($news as $post)

                            <div class="item post">
                                <div class="thumb-img">
                                    <img loading="lazy" src="{{ asset("img/preloader.png") }}"
                                         data-srcm="{{ $post->mobile_image_url }}"
                                         data-src="{{ $post->main_image_url }}" 
                                         alt="img 25">
                                    <a href="{{ route('news.single', ['slug' => $post->slug]) }}"
                                       class="full-size"></a>
                                </div>
                                <div class="thumb-content">
                                    <div class="title h3">
                                        <a href="{{ route('news.single', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </div>
                                    <span class="text text-sm">{{ $post->created_at?->format("d.m.Y") }}</span>
                                    <div class="text">
                                        <p>{{ $post->short_text }}</p>
                                        <x-seo-button :code="'goto.news'"
                                                      href="{{ route('news.single', ['slug' => $post->slug]) }}"
                                                      class="btn btn-read-more text-bold">{{ __("Читати більше") }}</x-seo-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="spacer-xs"></div>

                    {{ $news->links('paginate.vendor.pagination.default') }}

                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
