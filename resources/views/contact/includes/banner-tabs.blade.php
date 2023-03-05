@if($pictures->count() > 0)
    <div class="banner-tabs tabs">
        <div class="tabs-nav">
            <span class="tab-title"></span>
            <ul class="tab-toggle">
                <li class="tab-caption active">
                    <img loading="lazy" src="{{asset('img/preloader.png')}}"
                         data-img-src="{{asset('icon/photo.svg')}}"
                         alt="placeholder light">{{__('common.photos')}}
                </li>
            </ul>
        </div>
        <div class="tabs-wrap">
            <!-- TAB #1 -->
            <div class="tab active">
                <x-tour.gallery :slides="$pictures"/>
            </div>
            <!-- TAB #1 END -->
        </div>
    </div>
@endif
