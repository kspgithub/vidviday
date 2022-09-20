<div class="accordion-item">
    <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}"
                   data-img-src="{{asset('/icon/schedule.svg')}}"
                   alt="schedule"></span>@lang('tours-section.schedule')<i></i>
    </div>
    <div class="accordion-inner">
        <div class="calendar-header-center">
            <span class="text-sm">10+ @lang('tours-section.seats')</span>
            <span class="text-sm">2 — 10 @lang('tours-section.seats')</span>
            <span class="text-sm">@lang('tours-section.no-seats')</span>
        </div>
        <div class="schedule">
            <div class="schedule-header">
                <span class="text-sm">@lang('tours-section.departure-return-dates')</span>
                <span class="text-sm">@lang('tours-section.cost')</span>
            </div>

            @foreach($future_events as $event_key=>$future_event)

                <div class="schedule-row {{ $future_event->className }} {{$event_key > 2 ? 'd-none' : ''}}">
                    <span class="text">
                        @php
                            $parts = explode(',', $future_event->title);
                        @endphp
                        {!! $parts[0] !!}{{ ($parts[1] ?? false) ? ',' : '' }}
                        @if($parts[1] ?? false)
                            @if(Str::contains($parts[1], '-'))
                                <p class="wbr"></p>
                            @endif
                            {!! $parts[1] !!}
                        @endif
{{--                        {!! Str::replace(',',',<wbr/>',$future_event->title) !!}--}}
                    </span>
                    <div>
                        <span class="text text-medium">{{$future_event->price}} {{$future_event->currencyTitle}}</span>
                        @if(is_tour_agent() && (int)$future_event->commission > 0)
                            <span class="discount">
                                {{$future_event->commission}} {{$future_event->currencyTitle}}

                                <span class="tooltip-wrap red"><span
                                        class="tooltip text text-sm light">@lang('tours-section.commission')</span></span>
                            </span>
                        @endif
                    </div>

                    <a v-is="'tour-order-schedule-button'"
                       :tour='@json($tour)'
                       :schedule='@json($future_event)'
                       class="btn type-1"
                    ></a>

{{--                    @if($future_event->places_available === 0 || ($future_event->places_available >= 2 && $future_event->places_available <= 10))--}}

{{--                    @else--}}
{{--                        <a href="{{route('tour.order', ['tour'=>$tour->id, 'schedule'=>$future_event->id])}}"--}}
{{--                           class="btn type-1">@lang('tours-section.order')</a>--}}
{{--                    @endif--}}
                </div>
            @endforeach

        </div>
        @if($future_events->count() > 3)
            <div class="spacer-xs"></div>
            <div class="text-center">
                <span class="btn type-2 show-more-events">@lang('tours-section.show-more')</span>
                <span class="btn type-2 hide-more-events d-none">@lang('tours-section.hide-more')</span>
            </div>
        @endif
    </div>
</div>
