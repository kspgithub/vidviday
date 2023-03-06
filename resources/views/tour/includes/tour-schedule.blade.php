@if(count($tour->scheduleItems))
    <div class="accordion-item">
        <div class="accordion-title">
        <span>
            <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                 data-src="{{asset('/icon/schedule.svg')}}"
                 alt="schedule"/>
        </span>
            @lang('tours-section.schedule')
            <i></i>
        </div>

        <component :is="'tour-schedule-accordion'"
                   :tour='@json($tour->shortInfo())'
        />
    </div>
@endif
