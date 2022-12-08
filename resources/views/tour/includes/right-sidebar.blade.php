<div class="right-sidebar">

    <div class="right-sidebar-inner">
        <div class="only-desktop">
            <form action="{{route('tour.order', $tour)}}"
                  v-is="'tour-order'"
                  :tour='@json($tour->shortInfo())'
                  :nearest-event='@json($nearest_event->id ?? 0)'
                  :corporate="{{(!app()->environment('production') && !$future_events->count()) ? 'true' : 'false'}}"
            ></form>

        </div>

        <div class="spacer-xs"></div>

        @if($tour->tour_manager)
            <x-tour.manager :manager="$tour->tour_manager"/>
        @endif

        @if(!$nearest_event)
            <div v-is="'tour-voting-form'" :tour='@json($tour->shortInfo())'></div>
        @endif

        <div class="sidebar-item only-desktop hidden-print">
            <a download class="download" v-is="'print-btn'">
                <span class="text-md text-medium">@lang('tours-section.download-tour')</span>
            </a>
        </div>

        @include('tour.includes.sidebar-reviews')

        @if($nearest_event)
            <div class="only-mobile hidden-print">
                <a v-is="'tour-order-schedule-button'"
                   href="{{route('tour.order', $tour)}}"
                   :tour='@json($tour)'
                   :schedule='@json($nearest_event)'
                   class="btn type-1 btn-block"
                ></a>
            </div>
        @endif
    </div>

</div>
