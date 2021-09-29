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
                <div class="schedule-row still-have {{$event_key > 2 ? 'd-none' : ''}}">
                    <span class="text">{{$future_event->title}}</span>
                    <div>
                        <span class="text text-medium">{{$future_event->price}} грн.</span>
                        @if($future_event->comission > 0)
                            <span class="discount">{{$future_event->comission}} грн. <span
                                    class="tooltip-wrap red"><span
                                        class="tooltip text text-sm light">@lang('tours-section.commission')</span></span></span>
                        @endif
                    </div>
                    <a href="{{route('tour.order', ['tour'=>$tour->id, 'schedule'=>$future_event->id])}}"
                       class="btn type-1">@lang('tours-section.order')</a>
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
