<div class="banner-tabs tabs">
    <div class="tabs-nav">
        <span class="tab-title"></span>
        <ul class="tab-toggle">
            @if($pictures->count() > 0)
                <li class="tab-caption active">
                    <img src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{asset('/icon/photo.svg')}}"
                         alt="placeholder light">@lang('tours-section.banner-tabs.section-photo')
                </li>
            @endif
            @if($tour->show_map)
                <li class="tab-caption {{$pictures->count() > 0 ? '' : 'active'}}">
                    <img src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{asset('/icon/placeholder-light.svg')}}"
                         alt="placeholder light">@lang('tours-section.banner-tabs.section-map')
                </li>
            @endif
            @if(!empty($tour->video))
                <li class="tab-caption">
                    <img src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{asset('/icon/video.svg')}}"
                         alt="video">@lang('tours-section.banner-tabs.section-video')
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
    <!-- TAB #2 MAP -->
        <div class="tab {{$pictures->count() > 0 ? '' : 'active'}}">
            <div class="banner-tab-map">
                <div id="map-canvas"
                     class="map-wrapper places-map full-size"
                     data-lat="49.822385"
                     data-lng="24.023855"
                     data-zoom="15"
                     data-img-cluster="{{asset('icon/cluster.svg')}}?"
                ></div>
                @foreach($tour->places->map->asMapMarker() as $marker)
                    <div class="marker"
                         data-rel="map-canvas"
                         data-title="{{$marker->title}}"
                         data-lat="{{$marker->lat}}"
                         data-lng="{{$marker->lng}}"
                         data-image="{{asset('icon/marker-circle.svg')}}"
                         data-string="<a href='{{$marker->url}}' class='info-box-title text-nowrap'>{{$marker->title}}</a>">
                    </div>
                @endforeach
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
