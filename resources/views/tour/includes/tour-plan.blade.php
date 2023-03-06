@if($tour->planItems->count() > 0)
    <div class="accordion-item active">
        <div class="accordion-title">
    <span><img loading="lazy" src="{{asset('/img/preloader.png')}}"
               data-src="{{asset('/icon/plan.svg')}}"
               alt="plan"></span>@lang('tours-section.tour-plan')<i></i></div>
        <div class="accordion-inner" style="display: block;">
            <div class="text text-md">
                @if($tour->planItems->count() > 0)
                    {!! $tour->planItems->first()->text !!}
                @endif

            </div>
        </div>

    </div>
@endif

