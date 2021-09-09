<div class="accordion-item">
    <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}"
                   data-img-src="{{asset('/icon/places.svg')}}"
                   alt="places"></span>@lang('tours-section.places')<i></i>
    </div>
    <div class="accordion-inner">
        <div class="accordion type-2">
            @foreach($tour->places as $place)
                <div class="accordion-item">
                    <div class="accordion-title">{{$place->title}}<i></i></div>
                    <div class="accordion-inner">
                        @if($place->hasMedia())
                            <div class="swiper-entry" v-is="'swiper-slider'"
                                 :media='@json($place->getMedia()->map->toSwiperSlide())'
                            >
                            </div>
                            <div class="spacer-xs"></div>
                        @endif
                        <div class="load-more-wrapp">

                            <div class="text text-md">
                                {{str_limit(strip_tags($place->text), 500, '')}}
                            </div>
                            <div class="more-info">
                                <div class="text text-md">
                                    {{substr(strip_tags($place->text), 500)}}
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
