<div class="banner-tabs tabs">
    <div class="tabs-nav">
        <span class="tab-title"></span>
        <ul class="tab-toggle">
            <li class="tab-caption active">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/photo.svg')}}"
                     alt="placeholder light">Фото
            </li>

            <li class="tab-caption map-init">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/placeholder-light.svg')}}"
                     alt="placeholder light">Мапа
            </li>

            <li class="tab-caption">
                <img src="{{asset('/img/preloader.png')}}"
                     data-img-src="{{asset('/icon/video.svg')}}" alt="video">Відео
            </li>
        </ul>
    </div>
    <div class="tabs-wrap">
        <!-- TAB #1 -->
        <div class="tab active">
            <div class="banner-carousel">
                <div class="swiper-entry">
                    <div class="swiper-button-prev">
                        <i></i>
                    </div>
                    <div class="swiper-button-next">
                        <i></i>
                    </div>
                    <div class="swiper-container"
                         data-options='{"parallax": true, "speed": 900, "lazy": true}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{asset('/img/preloader.png')}}"
                                     data-src="{{asset('/img/banner-img_2.jpg')}}"
                                     alt="banner img 2" data-swiper-parallax="30%"
                                     class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <div class="full-size">
                                    <span>Іза. Оленяча ферма.</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('/img/preloader.png')}}"
                                     data-src="{{asset('/img/img_1.jpg')}}" alt="img 1"
                                     data-swiper-parallax="30%" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <div class="full-size">
                                    <span>Іза. Оленяча ферма.</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('/img/preloader.png')}}"
                                     data-src="{{asset('/img/banner-img.jpg')}}" alt="banner img"
                                     data-swiper-parallax="30%" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <div class="full-size">
                                    <span>Іза. Оленяча ферма.</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('/img/preloader.png')}}"
                                     data-src="{{asset('/img/img_1.jpg')}}" alt="img 1"
                                     data-swiper-parallax="30%" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <div class="full-size">
                                    <span>Іза. Оленяча ферма.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination light"></div>
                </div>
            </div>
        </div>
        <!-- TAB #1 END -->

        <!-- TAB #2 -->
        <div class="tab">
            <div class="banner-tab-map">
                <div id="map-canvas" class="map-wrapper hidden-map full-size" data-lat="49.822385"
                     data-lng="24.023855" data-zoom="15" data-img-cluster="img/cluster.png"></div>
                <a class="marker" data-rel="map-canvas-1" data-lat="49.822385" data-lng="24.023855"
                   data-image="img/marker.png"
                   data-string="<h5>Головний офіс</h5><p>Україна, 79018, м. Львів, вул. Вулиця, 555</p>"></a>
            </div>
        </div>
        <!-- TAB #2 END -->

        <!-- TAB #3 -->
        <div class="tab">
            <div class="video"
                 data-frame-src="{{asset('https://www.youtube.com/embed/BMQQQynlrn4')}}"></div>
        </div>
        <!-- TAB #3 END -->
    </div>
</div>
