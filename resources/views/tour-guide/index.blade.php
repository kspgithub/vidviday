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
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">@lang('Guides')</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    @include('includes.sidebar')
                    <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <!-- BANNER/INFO -->
                    <div class="section">
                        @include('page.includes.banner-tabs', [
                            'pictures'=>$pageContent->getMedia(),
                            'video'=>$pageContent->video
                        ])
                        <h1 class="h1 title">{{$pageContent->title}}</h1>
                        <div class="text text-md">
                            <p> {!! $pageContent->text !!}</p>
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <div class="section">
                        <div class="thumb-wrap row">
                            @foreach ($specialists as $specialist)
                                <div class="col-lg-4 col-md-6 col-12">
                                    @include('tour-guide.includes.card', ['specialist'=>$specialist])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- MOBILE BUTTONS BAR -->
                    <div class="only-pad-mobile">
                        <div class="row short-distance">
                            <div class="col-md-4 col-12 only-pad">
                                <x-seo-button key="tour.order" class="btn type-4 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</x-seo-button>
                            </div>

                            <div class="col-md-4 col-12 only-pad">
                                <x-seo-button key="download.schedule" href="{{route('tour.download')}}" download
                                   class="btn type-5 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/tours-scedule-dark.svg')}}"
                                        alt="tours scedule dark">Завантажити розклади турів</x-seo-button>
                            </div>

                            <div class="col-md-4 col-12">
                                <x-seo-button key="tour.select" class="btn type-5 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/filter-dark.svg')}}"
                                        alt="filter-dark">Підбір туру</x-seo-button>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- MOBILE BUTTONS BAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>

@endsection
