@props([
    'tour'=> new \App\Models\Tour(),
    'nearestEvent'=> null,
    'shareClass'=> '',
    'spacerClass'=> 'spacer-xs',
])

<form action="{{route('tour.order', $tour)}}">
    <div class="thumb-price">
        <span
            class="text">@lang('tours-section.price')<span>{{$nearestEvent ? $nearestEvent->price : $tour->price}}</span><i>грн</i></span>
        @if($nearestEvent && $nearestEvent->commission > 0)
            <span class="discount">{{$nearestEvent->commission}} грн <span class="tooltip-wrap red"><span
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
        @if($nearestEvent)
            <div class="single-datepicker">
                <div class="datepicker-input">
                    <input id="selected-event-id" type="hidden" name="event_id"
                           value="{{$nearestEvent ? $nearestEvent->id : 0}}">
                    <span id="selected-event-title" class="datepicker-placeholder open-popup calendar-init"
                          data-rel="calendar-popup">{{$nearestEvent ? $nearestEvent->title : ''}}</span>

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
                    class="thumb-info-people text">{{$nearestEvent->places > 00 ? '10+' : $nearestEvent->places}}</span>
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
