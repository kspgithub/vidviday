<div class="banner-tabs tabs">
    <div class="tabs-nav">
        <span class="tab-title"></span>
        <ul class="tab-toggle">
            <li class="tab-caption active">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/photo.svg')}}"
                     alt="placeholder light">Фото
            </li>

            <li class="tab-caption">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/placeholder-light.svg')}}"
                     alt="placeholder light">Мапа
            </li>

            <li class="tab-caption">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/video.svg')}}"
                     alt="video">Відео
            </li>
        </ul>
    </div>
    <div class="tabs-wrap">
        <!-- TAB #1 -->
        <div class="tab active">

            <x-tour.gallery
                :slides="$tour->hasMedia('pictures') ? $tour->getMedia('pictures') : [$tour->getMedia('main')]"/>
        </div>
        <!-- TAB #1 END -->

        <!-- TAB #2 -->
        <div class="tab">
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


@push('before-scripts')
    <!-- MAP SCRIPTS -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.maps_key')}}"></script>
@endpush
