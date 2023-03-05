<div class="banner-tabs tabs">
    <div class="tabs-nav">
        <span class="tab-title"></span>
        <ul class="tab-toggle">
            @if($pictures->count() > 0)
                <li class="tab-caption active">
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{asset('/icon/photo.svg')}}"
                         alt="placeholder light">@lang('tours-section.banner-tabs.section-photo')
                </li>
            @endif
            @if(!empty($video))
                <li class="tab-caption">
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
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
        @if(!empty($video))
            <!-- TAB #3 -->
            <div class="tab">
                <div class="video"
                     data-frame-src="{{youtube_embed($video)}}"></div>
            </div>
            <!-- TAB #3 END -->
        @endif
    </div>
</div>
