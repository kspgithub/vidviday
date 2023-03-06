@if($advertisement)
    <div class="sidebar-item notice">
        <div class="top-part">
            <div class="h3 light title-icon">
                <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                     data-src="{{asset('/icon/info.svg')}}"
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
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                         data-src="{{$advertisement->image_url}}"
                         alt="{{$advertisement->title}}">
                </a>
            @endif
        </div>
    </div>
@endif
