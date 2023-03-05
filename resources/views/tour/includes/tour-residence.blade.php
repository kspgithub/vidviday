@if(count($tour->groupTourAccommodations))
    @if(true || in_array('accommodation', $tour->active_tabs))
        <div class="accordion-item">
            <div class="accordion-title"><span><img loading="lazy" src="{{asset('/img/preloader.png')}}"
                                                    data-img-src="{{asset('/icon/keys.svg')}}"
                                                    alt="keys"></span>@lang('tours-section.accommodation')<i></i></div>
            <div class="accordion-inner">
                <div class="accordion type-2">
                    @if($sync = true)
                        @foreach($tour->groupTourAccommodations as $residence)
                            <div class="accordion-item active">
                                <div class="accordion-title">{{$residence->title}}
                                    @if($residence->nights)
                                        <span>(
                                        {{ $residence->nights }}
                                            {{trans_choice('tours-section.nights', (int) $residence->nights[strlen($residence->nights) - 1]) }}
                                    )</span>
                                    @endif
                                    <i></i>
                                </div>
                                <div class="accordion-inner" style="display: block">
                                    <x-swiper-media :slides="$residence->getMedia(filters: ['published' => true])"/>

                                    <div class="text text-md">
                                        <p>{!! $residence->text!!}</p>
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
