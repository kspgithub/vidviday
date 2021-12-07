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
            <li class="tab-caption {{$pictures->count() > 0 ? '' : 'active'}}">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/placeholder-light.svg')}}"
                     alt="placeholder light">Мапа
            </li>
            @if(!empty($tour->video))
                <li class="tab-caption">
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
    <!-- TAB #2 -->
        <div class="tab {{$pictures->count() > 0 ? '' : 'active'}}">
            <div class="banner-tab-map">
                <div class="map-wrapper hidden-map full-size"
                     v-is="'tour-map'"
                     :tour='@json($tour)'
                ></div>
            </div>
        </div>
        <!-- TAB #2 END -->
    @if(!empty($tour->video))
        <!-- TAB #3 -->
            <div class="tab">
                <div class="video"
                     data-frame-src="{{youtube_embed($tour->video)}}"></div>
            </div>
            <!-- TAB #3 END -->
        @endif
    </div>
</div>
