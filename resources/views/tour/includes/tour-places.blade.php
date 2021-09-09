<div class="accordion-item">
    <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}"
                   data-img-src="{{asset('/icon/places.svg')}}"
                   alt="places"></span>@lang('tours-section.places')<i></i>
    </div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->places as $place)
                <div class="accordion-item active">
                    <div class="accordion-title">{{$place->title}}<i></i></div>
                    <div class="accordion-inner">
                        @if($place->hasMedia())
                            <div class="swiper-entry">
                                <div class="swiper-button-prev">
                                    <i></i>
                                </div>
                                <div class="swiper-button-next">
                                    <i></i>
                                </div>
                                <div class="swiper-container"
                                     data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                    <div class="swiper-wrapper lightbox-wrap">
                                        @foreach($place->getMedia() as $media)
                                            <div class="swiper-slide">
                                                <div class="img zoom">
                                                    <img src="{{asset('/img/preloader.png')}}"
                                                         data-src="{{$media->getUrl()}}"
                                                         title="{{$media->getCustomProperty('title_'.app()->getLocale()) ?? $place->title}}"
                                                         alt="{{$media->getCustomProperty('alt_'.app()->getLocale()) ?? $place->title}}"
                                                         class="swiper-lazy">
                                                    <div class="swiper-lazy-preloader"></div>
                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="only-mobile swiper-pagination"></div>
                            </div>
                            <div class="spacer-xs"></div>
                        @endif
                        <div class="load-more-wrapp">
                            <div class="text text-md">
                                {{str_limit(strip_tags($place->text), 500)}}
                            </div>
                            <div class="more-info">
                                <div class="text text-md">
                                    {!! $place->text !!}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="spacer-xs"></div>
                                <div class="show-more">
                                    <span>@lang('tours-section.read-more')</span>
                                    <span>@lang('tours-section.hide-text')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
