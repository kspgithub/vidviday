@if(in_array('transport', $tour->active_tabs))
    <div class="accordion-item">
        <div class="accordion-title">
            <span class="accordion-icon">{{svg('bus')}}</span> @lang('tours-section.transport')<i></i>
        </div>
        <div class="accordion-inner">
            <div class="accordion type-2">
                @foreach($tour->groupTourTransport as $transport)
                    <div class="accordion-item">
                        <div class="accordion-title">{{$transport->title}} <i></i></div>
                        <div class="accordion-inner">
                            @if($transport->hasMedia())
                                <div class="swiper-entry" v-is="'swiper-slider'"
                                     key="swiper-place-{{$transport->id}}"
                                     :media='@json($transport->getMedia('default', ['published' => true])->values()->map->toSwiperSlide())'
                                >
                                </div>
                                <div class="spacer-xs"></div>
                            @endif
                            {{--                        <img src="{{$transport->image_url}}" alt="{{$transport->image_alt}}" style="width: 50%;">--}}

                            <div class="text text-md">
                                <p>{!! $transport->text!!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
