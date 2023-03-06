<div class="banner-tabs tabs">
    <div class="tabs-nav">
        <span class="tab-title"></span>
        <ul class="tab-toggle">
            @if($pictures->count() > 0)
                <li class="tab-caption active">
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                         data-src="{{asset('/icon/photo.svg')}}"
                         alt="placeholder light">Фото
                </li>
            @endif
            <li class="tab-caption {{$pictures->count() > 0 ? '' : 'active'}}">
                <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                     data-src="{{asset('/icon/placeholder-light.svg')}}"
                     alt="placeholder light">Мапа
            </li>
            @if(!empty($place->video))
                <li class="tab-caption">
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                         data-src="{{asset('/icon/video.svg')}}"
                         alt="video">Відео
                </li>
            @endif
        </ul>
    </div>
    <div class="tabs-wrap">
    @if($pictures->count() > 0)
        <!-- TAB #1 -->
            <div class="tab active">

                <x-tour.gallery :slides="$pictures"/>
            </div>
            <!-- TAB #1 END -->
    @endif
    <!-- TAB #2 -->
        <div class="tab {{$pictures->count() > 0 ? '' : 'active'}}">
            <div class="banner-tab-map">
                <div class="map-wrapper hidden-map full-size">
                    <div id="map-canvas"
                         class="map-wrapper full-size"
                         data-lat="{{$place->lat}}"
                         data-lng="{{$place->lng}}"
                         data-zoom="8"
                         data-img-cluster="{{asset('icon/cluster.svg')}}?"
                    ></div>
                    <div class="marker"
                         data-rel="map-canvas"
                         data-title="{{$place->title}}"
                         data-lat="{{$place->lat}}"
                         data-lng="{{$place->lng}}"
                         data-image="{{asset('icon/marker-circle.svg')}}"
                         data-string="<span class='info-box-title text-nowrap'>{{$place->title}}</span>"></div>
                </div>
            </div>
        </div>
        <!-- TAB #2 END -->
    @if(!empty($place->video))
        <!-- TAB #3 -->
            <div class="tab">
                <div class="video"
                     data-frame-src="{{youtube_embed($place->video)}}"></div>
            </div>
            <!-- TAB #3 END -->
        @endif
    </div>
</div>
