<div class="right-sidebar">

    <div class="right-sidebar-inner">
        <div class="only-desktop">
            <form action="{{route('tour.order', $tour)}}"
                  v-is="'tour-order'"
                  :tour='@json($tour->shortInfo())'
                  :corporate="{{$future_events->count() > 0 ? 'false' : 'true'}}"
            ></form>

        </div>

        <div class="spacer-xs"></div>

        <x-tour.manager :tour="$tour"/>

        <div class="sidebar-item only-desktop">
            <a href="{{asset('/document/document.pdf')}}" download class="download">
                <span class="text-md text-medium">@lang('tours-section.download-tour')</span>
            </a>
        </div>

        @include('tour.includes.sidebar-reviews')

        <div class="only-mobile">
            <a href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">@lang('tours-section.order-tour')</a>
        </div>
    </div>

</div>
