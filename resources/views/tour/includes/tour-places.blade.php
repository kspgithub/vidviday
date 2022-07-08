@if(in_array('places', $tour->active_tabs))
    <div class="accordion-item">
        <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}"
                   data-img-src="{{asset('/icon/places.svg')}}"
                   alt="places"></span>@lang('tours-section.places')<i></i>
        </div>
        <div class="accordion-inner">
            <div class="accordion type-2">
                @foreach($tour->groupTourPlaces as $place)
                    <div class="accordion-item active">
                        <div class="accordion-title">{{$place->title}}<i></i></div>
                        <div class="accordion-inner" style="display: block">
                            @if($place->hasMedia('default', ['published' => true]))
                                <div class="swiper-entry" v-is="'swiper-slider'"
                                     key="swiper-place-{{$place->id}}"
                                     :media='@json($place->getMedia('default', ['published' => true])->map->toSwiperSlide())'
                                     :buttons="true"
                                >
                                </div>
                                <div class="spacer-xs"></div>
                            @endif

                            <div class="load-more-wrapp">

                                <div class="less-info">
                                    <div class="text text-md">
                                        {!! str_limit(strip_tags(html_entity_decode($place->text)), 300, '...') !!}
                                    </div>
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
@endif
