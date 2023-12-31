@if(!empty($tour->hutsul_fun_title) && !empty($tour->hutsul_fun_text))
    @if(true || in_array('hutsul_fun', $tour->active_tabs))
        <div class="accordion-item">
            <div class="accordion-title">
            <span>
                <img loading="lazy" src="{{asset('/img/preloader.png')}}" data-src="{{asset('/icon/infobox.svg')}}" alt="axe">
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
@endif
