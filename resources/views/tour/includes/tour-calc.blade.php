@if(count($future_events))
    <div class="accordion-item  hidden-print">
        <div class="accordion-title">
        <span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/calculator.svg')}}"
                   alt="calculator"></span>
            @lang('tours-section.tour-calc') <i></i>
        </div>
        <div class="accordion-inner">
            <form action="/" class="calc-form"
                  v-is="'tour-calc'"
                  :tour='@json($tour->shortInfo())'
                  :future-events='@json($future_events->map->shortInfo())'
                  :price-items='@json($price_items)'

            >

            </form>
        </div>
    </div>
@endif
