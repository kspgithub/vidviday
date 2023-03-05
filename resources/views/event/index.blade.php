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
                    <span itemprop="name">@lang('Events')</span>
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
                    @include('page.includes.banner-tabs', [
                           'pictures'=>$pageContent->getMedia(),
                           'video'=>$pageContent->video
                       ])
                    <div class="spacer-xs"></div>
                    <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>

                    <div class="spacer-xs"></div>
                    <x-tour.mobile-search-btn/>
                @if($eventGroups->count() > 0)
                    <!-- ACCORDIONS CONTENT -->
                        <div class="accordion-all-expand inner-not-expand">
                            <div class="expand-all-button">
                                <div class="expand-all open">@lang('common.expand-all')</div>
                                <div class="expand-all close">@lang('common.collapse-all')</div>
                            </div>

                            <div class="accordion type-4 accordions-inner-wrap">
                                @foreach ($eventGroups as $group)
                                    <div class="accordion-item {{$loop->first ? 'active' : ''}}">

                                        <div class="accordion-title">{{$group->title}}<i></i></div>
                                        <div class="accordion-inner"
                                             style="display: {{$loop->first ? 'block' : 'none'}}">

                                            <div class="accordion type-2">
                                                @foreach($group->events as $event)
                                                    <div class="accordion-item ">
                                                        <div class="accordion-title">{{$event->title}}<i></i></div>
                                                        <div class="accordion-inner">
                                                            @if($event->hasMedia())
                                                                <div class="swiper-entry" v-is="'swiper-slider'"
                                                                    key="swiper-event-{{$event->id}}"
                                                                    :buttons='{{count($event->getMedia()) > 4 ? 'true' : 'false'}}'
                                                                    :media='@json($event->getMedia()->values()->map->toSwiperSlide())'
                                                                >
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                            @endif
                                                            <div class="text text-md">

                                                                <p>
                                                                    @if(!empty($event->short_text))
                                                                        {{$event->short_text}}
                                                                    @else
                                                                        {!! str_limit(strip_tags(html_entity_decode($event->text)) , 500) !!}
                                                                    @endif
                                                                    <x-seo-button :code="'goto.event'" href="{{$event->url}}"
                                                                    class="btn btn-read-more text-bold">@lang('common.more')</x-seo-button>
                                                                </p>


                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="expand-all-button">
                                <div class="expand-all open">@lang('common.expand-all')</div>
                                <div class="expand-all close">@lang('common.collapse-all')</div>
                            </div>
                        </div>
                @endif
                <!-- ACCORDIONS CONTENT END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
        <!-- MOBILE BUTTONS BAR -->
    @include('includes.mobile-btns-bar')
    <!-- MOBILE BUTTONS BAR END -->
    </main>
@endsection
