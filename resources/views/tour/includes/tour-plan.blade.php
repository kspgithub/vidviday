<div class="accordion-item active">
    <div class="accordion-title">
    <span><img src="{{asset('/img/preloader.png')}}"
               data-img-src="{{asset('/icon/plan.svg')}}"
               alt="plan"></span>План туру<i></i></div>
    <div class="accordion-inner" style="display: block;">
        <div class="text text-md">
            @if($tour->planItems->count() > 0)
                {!! $tour->planItems->first()->text !!}
            @endif

        </div>
    </div>

</div>
