@if($tour->hutsul_fun_on)
    <div class="accordion-item">
        <div class="accordion-title">
            <span>
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/infobox.svg')}}" alt="axe">
            </span>
            {{!empty($tour->hutsul_fun_title) ? $tour->hutsul_fun_title : __('tours-section.fun')}}
            <i></i>
        </div>
        <div class="accordion-inner">
            <div class="text text-md">
                {!! $tour->hutsul_fun_text !!}
            </div>
        </div>
    </div>
@endif
