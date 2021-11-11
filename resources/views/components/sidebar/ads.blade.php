@if($advertisement)
    <div class="sidebar-item notice">
        <div class="top-part">
            <div class="h3 light title-icon">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/info.svg')}}"
                     alt="@lang('Advertisement')">
                @lang('Advertisement')
            </div>
        </div>
        <div class="bottom-part">
            <div class="text">
                <p>{{$advertisement->text}}</p>
            </div>
            @if(!empty($advertisement->image))
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{$advertisement->image_url}}"
                     alt="{{$advertisement->title}}">
            @endif
        </div>
    </div>
@endif
