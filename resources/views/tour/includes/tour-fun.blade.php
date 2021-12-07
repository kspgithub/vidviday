@if($tour->hutsul_fun_on)
    <div class="accordion-item">
        <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}"
                                                data-img-src="{{asset('/icon/axe.svg')}}"
                                                alt="axe"></span>@lang('tours-section.fun')<i></i>
        </div>
        <div class="accordion-inner">
            <div class="text text-md">
                {!! $tour->hutsul_fun_text !!}
            </div>
        </div>
    </div>
@endif
