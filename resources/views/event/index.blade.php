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
                <span>@lang('Events')</span>
            </div>
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
                @if($directions->count() > 0)
                    <!-- ACCORDIONS CONTENT -->
                        <div class="accordion-all-expand inner-not-expand">
                            <div class="expand-all-button">
                                <div class="expand-all open">@lang('common.expand-all')</div>
                                <div class="expand-all close">@lang('common.collapse-all')</div>
                            </div>

                            <div class="accordion type-4 accordions-inner-wrap">
                                @foreach ($directions as  $direction)
                                    <div class="accordion-item {{$loop->first ? 'active' : ''}}">
                                        <div class="accordion-title">{{$direction->title}}<i></i></div>

                                        <div class="accordion-inner"
                                             style="display: {{$loop->first ? 'block' : 'none'}}">

                                            <div class="accordion type-2">
                                                @foreach($direction->groupedEvents() as $group)
                                                    <div class="accordion-item {{$loop->first ? 'active' : ''}}">

                                                        <div class="accordion-title">{{$group->title}}<i></i></div>
                                                        <div class="accordion-inner"
                                                             style="display: {{$loop->first ? 'block' : 'none'}}">

                                                            @foreach($group->events as $event)
                                                                <div class="mb-30 border-bottom">
                                                                    @if($event->hasMedia())
                                                                        <div class="swiper-entry" v-is="'swiper-slider'"
                                                                             key="swiper-event-{{$event->id}}"
                                                                             :buttons='{{count($event->getMedia()) > 4 ? 'true' : 'false'}}'
                                                                             :media='@json($event->getMedia()->map->toSwiperSlide())'
                                                                        >
                                                                        </div>
                                                                        <div class="spacer-xs"></div>
                                                                    @endif
                                                                    <div class="text text-md">
                                                                        <h2>{{$event->title}}</h2>
                                                                        <p>
                                                                            @if(!empty($event->short_text))
                                                                                {{$event->short_text}}
                                                                            @else
                                                                                {!! str_limit(strip_tags($event->text) , 500) !!}
                                                                            @endif
                                                                            <a href="{{$event->url}}"
                                                                               class="btn btn-read-more text-bold">@lang('common.more')</a>
                                                                        </p>


                                                                    </div>
                                                                </div>
                                                            @endforeach
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
