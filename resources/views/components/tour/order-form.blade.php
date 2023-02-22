@props([
    'tour'=> new \App\Models\Tour(),
    'schedules'=> [],
    'nearestEvent'=> null,
    'shareClass'=> '',
    'spacerClass'=> 'spacer-xs',
])

<form action="{{route('tour.order', $tour)}}"
      v-is="'tour-order'"
      :tour='@json($tour->shortInfo())'
      :schedules='@json($schedules)'
      :nearest-event='@json($nearestEvent->id ?? 0)'
>

    @if($tour->order_enabled)
        <div class="thumb-price">
            <span
                class="text">@lang('tours-section.price')<span>{{$nearestEvent ? $nearestEvent->price : $tour->price}}</span><i>грн</i></span>
            @if($nearestEvent && $nearestEvent->commission > 0)
                <span class="discount hidden-print">{{$nearestEvent->commission}} грн <span class="tooltip-wrap red"><span
                            class="tooltip text text-sm light">@lang('tours-section.commission')</span></span></span>
            @endif
        </div>
    @endif

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
                    {!! $tour->format_duration !!}
                </span>
                <span
                    class="thumb-info-people text">
                    {{$nearestEvent->places_available >= 10 ? '10+' : ($nearestEvent->places_available < 2 ? '2-10' : '0')}}
                </span>
            </div>
            <x-seo-button key="order.tour" href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">@lang('tours-section.order-tour')</x-seo-button>
            <x-seo-button key="order.one_click" class="btn type-2 btn-block open-popup"
                  data-rel="one-click-popup">@lang('tours-section.order-one-click')</x-seo-button>
            <div class="thumb-info">
                <span class="thumb-info-time text">{{$tour->duration}}д / {{$tour->nights}}н</span>
            </div>
            <x-seo-button key="order.corporate" href="{{route('tour.order', $tour)}}"
               class="btn type-2 btn-block">@lang('tours-section.order-corporate')</x-seo-button>
        @endif
    </div>
</form>
