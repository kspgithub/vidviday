@extends("layout.app")

@section("title")
    {{ "Відвідай | ". $newsSingle->title }}
@endsection

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ $newsSingle->title }}">
    <meta property="og:description" content="{{ $newsSingle->short_text }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $newsSingle->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
        <meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@section("content")

    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->

            @include("news.includes.bread_crumbs", ["title" => $newsSingle->title])

            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    @include('includes.sidebar')
                    <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <div class="only-pad-mobile">
                        <x-seo-button :code="'tour.select'" class="btn type-5 arrow-right text-left flex">
                            <img loading="lazy" src="{{ asset("img/preloader.png") }}"
                                 data-src="{{ asset('icon/filter-dark.svg') }}" alt="filter-dark">
                            {{ __("Підбір туру") }}
                        </x-seo-button>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO -->
                    <div class="banner-img">
                        @foreach($newsSingle->media as $media)
                            @if($media->collection_name === "main")
                                <img loading="lazy" src="{{ asset("img/preloader.png") }}"
                                     data-src="{{ $media->getUrl('thumb') }}"
                                     alt="banner img 11">
                            @endif
                        @endforeach
                    </div>
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{ $newsSingle->title }}</h1>
                    <div class="spacer-xxs"></div>
                    <span class="text-sm">
                        {{ $newsSingle->created_at?->format("d.m.Y") }}
                    </span>
                    <div class="spacer-xxs"></div>
                    <!-- BANNER/INFO END -->

                    @php
                        $pictures = $newsSingle->getMedia();
                    @endphp

                    @if($pictures->count() > 0 || $newsSingle->video)
                        <div class="spacer-xs"></div>
                        <!-- SLIDER -->
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1 col-12">
                                <div class="default-slider swiper-entry">
                                    <div class="swiper-container"
                                         data-options='{
                                             "loop": {{ $pictures->count() > 1 ? 'true' : 'false' }},
                                             "autoHeight": true,
                                             "parallax": true,
                                             "spaceBetween": 20
                                         }'>
                                        <div class="swiper-wrapper">

                                            @if($newsSingle->video)
                                                <div class="swiper-slide">
                                                    <div class="img img-border">
                                                        <div class="video"
                                                             data-frame-src="{{youtube_embed($newsSingle->video)}}"></div>
                                                    </div>
                                                </div>
                                            @endif

                                            @foreach($pictures as $media)
                                                <div class="swiper-slide">
                                                    <div class="img img-border">
                                                        <img
                                                            src="{{ asset('storage/media/news/'.$media->id.'/'.$media->file_name) }}"
                                                            alt="img 28" data-swiper-parallax="30%">
                                                    </div>
                                                    <div class="text-center">

                                                        <span
                                                            class="text-sm">{{ $media->custom_properties["title_".app()->getLocale()] ?? '' }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev outside bottom-sm">
                                        <i></i>
                                    </div>
                                    <div class="swiper-pagination only-pad-mobile relative"></div>
                                    <div class="swiper-button-next outside bottom-sm">
                                        <i></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SLIDER END -->
                        <div class="spacer-xs"></div>
                    @endif
                    <!-- POST CONTENT -->
                    <div class="text text-md">
                        {!!  $newsSingle->text !!}
                    </div>

                    <div class="spacer-xs"></div>
                    <div class="social post-social">
                        <span>{{ __('Поділитись') }}:</span>

                        <div v-is="'share-dropdown'" share-url="{{url()->current()}}"
                             share-title="{{ $newsSingle->title }}"></div>

                        <a href="/document/document.pdf" download print class="download only-desktop only">
                            <span class="text-md text-medium">{{ __('tours-section.download-tour') }}</span>
                        </a>
                    </div>

                    <!-- POST CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection
