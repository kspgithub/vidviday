@if($advertisement)
    <div class="sidebar-item notice">
        <div class="top-part">
            <div class="h3 light title-icon">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/info.svg')}}"
                     alt="@lang('idebar-section.ads')">
                @lang('sidebar-section.ads')
            </div>
        </div>
        <div class="bottom-part">
            <div class="text">
                {!! $advertisement->text !!}
            </div>
            @if(!empty($advertisement->image))
                <a href="{{ $advertisement->url }}">
                    <img loading="lazy"
                         src="{{asset('/img/preloader.png')}}"
                         width="{{$advertisement->image_width}}"
                         height="{{$advertisement->image_height}}"
                         data-img-src="{{$advertisement->image_url}}"
                         alt="{{$advertisement->title}}">
                </a>
            @endif
        </div>
    </div>
@endif
