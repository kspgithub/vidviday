<div class="tab active">
    <div class="spacer-xs"></div>
    @include('tour.includes.sorting')
    <div class="spacer-xs"></div>
    <!-- THUMBS -->
    <div class="thumb-wrap row">
        @foreach($tours as $tour)
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <x-tour.card :tour="$tour"/>
            </div>
        @endforeach

        <div class="col-12">
            <div class="spacer-xs"></div>
            <div class="text-center">
                <span v-bind="$buttons.tour.show_more" class="btn type-2">@lang('tours-section.show-more-12')</span>
            </div>
        </div>
    </div>
    <!-- THUMBS END -->
</div>
