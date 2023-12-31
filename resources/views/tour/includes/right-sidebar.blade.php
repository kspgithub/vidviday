<div class="right-sidebar">

    <div class="right-sidebar-inner">
        <div class="only-desktop">
            <form action="{{route('tour.order', $tour)}}"
                  v-is="'tour-order'"
                  :tour='@json($tour->shortInfo())'
                  :schedules='@json($future_events->map->shortInfo())'
                  :nearest-event='@json($nearest_event->id ?? 0)'
                  :corporate="{{(!app()->environment('production') && !$future_events->count()) ? 'true' : 'false'}}"
            ></form>

        </div>

        <div class="spacer-xs"></div>

        @if($tour->tour_manager)
            <x-tour.manager :manager="$tour->tour_manager"/>
        @endif

        @if(!$nearest_event)
            <div v-is="'tour-voting-form'"
                 :tour='@json($tour->shortInfo())'
            ></div>
        @endif

        <div class="sidebar-item only-desktop hidden-print">
            <a download class="download" v-is="'print-btn'">
                <span class="text-md text-medium">@lang('tours-section.download-tour')</span>
            </a>
        </div>

        @include('tour.includes.sidebar-reviews')

        @if($nearest_event)
            <div class="only-mobile hidden-print">
                <x-seo-button :code="'tour.order'"
                              v-is="'tour-order-schedule-button'"
                              href="{{route('tour.order', $tour)}}"
                              tour-id="{{ $tour->id }}"
                              schedule-id="{{ $nearest_event->id }}"
                              class="btn type-1 btn-block"
                ></x-seo-button>
            </div>
        @endif
    </div>

</div>
