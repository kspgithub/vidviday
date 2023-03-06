@if(count($tour->groupTourTransport))
    @if(true || in_array('transport', $tour->active_tabs))
        <div class="accordion-item">
            <div class="accordion-title">
                <span class="accordion-icon">{{svg('bus')}}</span> @lang('tours-section.transport')<i></i>
            </div>
            <div class="accordion-inner">
                <div class="accordion type-2">
                    @if($sync = true)
                        @foreach($tour->groupTourTransport as $transport)
                            <div class="accordion-item">
                                <div class="accordion-title">{{$transport->title}} <i></i></div>
                                <div class="accordion-inner">
                                    @if($transport->hasMedia(filters: ['published' => true]))
                                        <div class="swiper-entry" v-is="'swiper-slider'"
                                             key="swiper-place-{{$transport->id}}"
                                             :media='@json($transport->getMedia('default', ['published' => true])->values()->map->toSwiperSlide())'
                                        >
                                        </div>
                                        <div class="spacer-xs"></div>
                                    @endif
                                    {{--                        <img loading="lazy" data-src="{{$transport->image_url}}" alt="{{$transport->image_alt}}" style="width: 50%;">--}}

                                    <div class="text text-md">
                                        <p>{!! $transport->text!!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
