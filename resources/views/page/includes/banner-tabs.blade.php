@if($pictures->count() > 0 || !empty($video))
    <div class="banner-tabs tabs">
        <div class="tabs-nav">
            <span class="tab-title"></span>
            <ul class="tab-toggle">
                @if($pictures->count() > 0)
                    <li class="tab-caption active">
                        <img src="{{asset('/img/preloader.png')}}"
                             data-img-src="{{asset('/icon/photo.svg')}}"
                             alt="placeholder light">Фото
                    </li>
                @endif
                @if(!empty($video))
                    <li class="tab-caption {{$pictures->count() === 0 ? 'active' : ''}}">
                        <img src="{{asset('/img/preloader.png')}}"
                             data-img-src="{{asset('/icon/video.svg')}}"
                             alt="video">Відео
                    </li>
                @endif
            </ul>
        </div>
        <div class="tabs-wrap">
            @if($pictures->count() > 0)
                <!-- TAB #1 -->
                <div class="tab active">

                    <x-tour.gallery
                        :slides="$pictures"/>
                </div>
                <!-- TAB #1 END -->
            @endif
            @if(!empty($video))
                <!-- TAB #2 -->
                <div class="tab {{$pictures->count() === 0 ? 'active' : ''}}">
                    <div class="video"
                         data-frame-src="{{youtube_embed($video)}}"></div>
                </div>
                <!-- TAB #2 END -->
            @endif
        </div>
    </div>
    <div class="spacer-xs"></div>
@endif
