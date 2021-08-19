@props([
    'tour'=> new \App\Models\Tour(),
    'nearest_event'=> null,
    'shareClass'=> '',
    'spacerClass'=> 'spacer-xs',
])

<form class="sidebar-item" action="{{route('tour.order', $tour)}}">
    <div class="thumb-price">
        <span
            class="text">@lang('tours-section.price')<span>{{$nearest_event ? $nearest_event->price : $tour->price}}</span><i>грн</i></span>
        @if($nearest_event && $nearest_event->commission > 0)
            <span class="discount">{{$nearest_event->commission}} грн <span class="tooltip-wrap red"><span
                        class="tooltip text text-sm light">@lang('tours-section.commission')</span></span></span>
        @endif
    </div>

    <div class="{{$shareClass}}">
        <x-tour.star-rating :rating="$tour->rating" :count="$tour->testimonials_count" :trigger="true"/>

        <x-tour.share :tour="$tour"/>

        <x-tour.like-btn :tour="$tour"/>

    </div>

    <div class="{{$spacerClass}}"></div>


    <div class="sidebar-item">
        @if($nearest_event)
            <div class="single-datepicker">
                <div class="datepicker-input">
                    <input id="selected-event-id" type="hidden" name="event_id"
                           value="{{$nearest_event ? $nearest_event->id : 0}}">
                    <span id="selected-event-title" class="datepicker-placeholder open-popup calendar-init"
                          data-rel="calendar-popup">{{$nearest_event ? $nearest_event->title : ''}}</span>

                    <!-- <div class="datepicker-toggle">
                        <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                    </div> -->
                </div>
            </div>
            <div class="thumb-info">
                <span class="thumb-info-time text">
                    {{$tour->duration.__('tours-section.days-letter')}} / {{$tour->nights.__('tours-section.nights-letter')}}
                </span>
                <span
                    class="thumb-info-people text">{{$nearest_event->places > 00 ? '10+' : $nearest_event->places}}</span>
            </div>
            <a href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">@lang('tours-section.order-tour')</a>
            <span class="btn type-2 btn-block open-popup"
                  data-rel="one-click-popup">@lang('tours-section.order-one-click')</span>

        @else
            <div class="thumb-info">
                <span class="thumb-info-time text">{{$tour->duration}}д / {{$tour->nights}}н</span>
            </div>
            <a href="{{route('tour.order', $tour)}}"
               class="btn type-2 btn-block">@lang('tours-section.order-corporate')</a>
        @endif
    </div>
</form>
