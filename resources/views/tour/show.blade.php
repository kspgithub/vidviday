@extends('layout.app')

@section('title', $tour->seo_title)

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">Головна</a>
                <span>—</span>
                <a href="{{route('tour.index')}}">Тури</a>
                <span>—</span>
                <span>{{$tour->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                    <div class="banner-tabs tabs">
                        <div class="tabs-nav">
                            <span class="tab-title"></span>
                            <ul class="tab-toggle">
                                <li class="tab-caption active"><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/photo.svg')}}" alt="placeholder light">Фото</li>

                                <li class="tab-caption map-init"><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/placeholder-light.svg')}}" alt="placeholder light">Мапа</li>

                                <li class="tab-caption"><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/video.svg')}}" alt="video">Відео</li>
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
                                        <div class="swiper-container" data-options='{"parallax": true, "speed": 900, "lazy": true}'>
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/banner-img_2.jpg')}}" alt="banner img 2" data-swiper-parallax="30%" class="swiper-lazy">
                                                    <div class="swiper-lazy-preloader"></div>
                                                    <div class="full-size">
                                                        <span>Іза. Оленяча ферма.</span>
                                                    </div>
                                                </div>

                                                <div class="swiper-slide">
                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_1.jpg')}}" alt="img 1" data-swiper-parallax="30%" class="swiper-lazy">
                                                    <div class="swiper-lazy-preloader"></div>
                                                    <div class="full-size">
                                                        <span>Іза. Оленяча ферма.</span>
                                                    </div>
                                                </div>

                                                <div class="swiper-slide">
                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/banner-img.jpg')}}" alt="banner img" data-swiper-parallax="30%" class="swiper-lazy">
                                                    <div class="swiper-lazy-preloader"></div>
                                                    <div class="full-size">
                                                        <span>Іза. Оленяча ферма.</span>
                                                    </div>
                                                </div>

                                                <div class="swiper-slide">
                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_1.jpg')}}" alt="img 1" data-swiper-parallax="30%" class="swiper-lazy">
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
                                    <div id="map-canvas" class="map-wrapper hidden-map full-size" data-lat="49.822385" data-lng="24.023855" data-zoom="15" data-img-cluster="img/cluster.png"></div>
                                    <a class="marker" data-rel="map-canvas-1" data-lat="49.822385" data-lng="24.023855" data-image="img/marker.png" data-string="<h5>Головний офіс</h5><p>Україна, 79018, м. Львів, вул. Вулиця, 555</p>"></a>
                                </div>
                            </div>
                            <!-- TAB #2 END -->

                            <!-- TAB #3 -->
                            <div class="tab">
                                <div class="video" data-frame-src="{{asset('https://www.youtube.com/embed/BMQQQynlrn4')}}"></div>
                            </div>
                            <!-- TAB #3 END -->
                        </div>
                    </div>
                    <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- TOUR CONTENT -->
                    <div class="tour-content">
                        <div class="row">
                            <div class="col-12 order-md-1">
                                <h1 class="h1 title">{{$tour->seo_h1}}</h1>
                                <div class="spacer-xs"></div>
                                <div class="only-pad-mobile">
									<span class="stars select-stars stars-selected">
										<i class="select-icon icon-star"></i>
										<i class="select-icon icon-star"></i>
										<i class="select-icon icon-star"></i>
										<i class="select-icon icon-star"></i>
										<i class="select-icon icon-star-empty"></i>
										<a href="#reviews-accordion" class="text accordion-open-trigger">14 відгуків</a>
									</span>

                                    <div class="share dropdown">
                                        <div class="icon">
                                            <div class="dropdown-btn full-size"></div>
                                        </div>
                                        <div class="dropdown-toggle">
                                            <div class="social style-1">
                                                <a href="https://www.facebook.com/vidviday">
                                                    <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z" fill="#4267B2"/></svg>
                                                </a>

                                                <a href="https://twitter.com/vidviday">
                                                    <svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z" fill="#179CDE"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="add-to-like">
										<span class="icon">
											<svg width="26" height="25" viewBox="0 0 26 25" xmlns="http://www.w3.org/2000/svg"><path d="M18.625.75C16.45.75 14.363 1.762 13 3.362 11.637 1.762 9.55.75 7.375.75 3.525.75.5 3.775.5 7.625.5 12.35 4.75 16.2 11.188 22.05L13 23.687l1.813-1.65C21.25 16.2 25.5 12.35 25.5 7.626c0-3.85-3.025-6.875-6.875-6.875zm-5.5 19.438l-.125.125-.125-.125C6.925 14.8 3 11.238 3 7.624c0-2.5 1.875-4.375 4.375-4.375 1.925 0 3.8 1.237 4.463 2.95h2.337c.65-1.713 2.525-2.95 4.45-2.95 2.5 0 4.375 1.875 4.375 4.375 0 3.613-3.925 7.175-9.875 12.563z" stroke-linecap="round"/></svg>
										</span>
                                        <span class="text only-desktop only">
											<span>В улюблені</span>
											<span>В улюблених</span>
										</span>
                                    </div>
                                </div>
                                <div class="spacer-xs only-pad-mobile"></div>
                            </div>

                            <div class="col-xl-12 col-md-5 col-12 order-md-3">
                                <div class="right-sidebar">
                                    <div class="right-sidebar-inner only-mobile">
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                        </div>

                                        <div class="only-desktop">
											<span class="stars select-stars stars-selected">
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">14 відгуків</span>
											</span>

                                            <div class="share dropdown">
                                                <div class="icon">
                                                    <div class="dropdown-btn full-size"></div>
                                                </div>
                                                <div class="dropdown-toggle">
                                                    <div class="social style-1">
                                                        <a href="https://www.facebook.com/vidviday">
                                                            <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z" fill="#4267B2"/></svg>
                                                        </a>

                                                        <a href="https://twitter.com/vidviday">
                                                            <svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z" fill="#179CDE"/></svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="add-to-like">
												<span class="icon">
													<svg width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.079.888C11.464.296 10.616 0 9.532 0c-.3 0-.606.051-.918.154a3.73 3.73 0 00-.87.415c-.268.175-.5.338-.693.49a6.664 6.664 0 00-.551.488 6.678 6.678 0 00-.551-.487 9.296 9.296 0 00-.693-.49 3.736 3.736 0 00-.87-.416A2.927 2.927 0 003.467 0C2.384 0 1.536.296.92.888.307 1.48 0 2.301 0 3.352c0 .32.057.649.17.988.114.339.244.628.389.866.145.239.31.472.493.699.184.226.318.383.403.469.084.086.15.148.199.186l4.527 4.311A.437.437 0 006.5 11a.437.437 0 00.32-.129l4.519-4.297C12.446 5.481 13 4.407 13 3.351c0-1.05-.307-1.871-.921-2.463z"/></svg>
												</span>
                                                <span class="text">
													<span>В улюблені</span>
													<span>В улюблених</span>
												</span>
                                            </div>
                                        </div>

                                        <div class="spacer-xs only-desktop"></div>

                                        <div class="sidebar-item">
                                            <div class="single-datepicker">
                                                <div class="datepicker-input">
                                                    <span class="datepicker-placeholder open-popup calendar-init" data-rel="calendar-popup">Сб - Нд, 16 - 17.11.2019</span>
                                                </div>
                                            </div>

                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>

                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                                <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                            </div>

                                            <span class="btn type-1 btn-block open-popup calendar-init" data-rel="calendar-popup">Замовити Тур</span>

                                            <span class="btn type-2 btn-block open-popup" data-rel="one-click-popup">Замовити в 1 клік</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="spacer-xs"></div>
                            </div>

                            <div class="col-xl-12 col-md-7 col-12 order-md-2">
                                <div class="text text-md border-right-pad">
                                    <p>Манявський водоспад і монастир, розваги на полонині Перці, найгарніші панорами Карпат, озера на Драгобраті.</p>
                                    <p>В програмі туру «Від Маняви до Драгобрату»: Український Афон – Скит Манявський, найгарніший карпатський водоспад – Манявський, підйом на полонину Драгобрат хребта Свидовець, огляд карпатських панорам та озера Герашаська-Догяска, полонина «Перці».</p>
                                </div>
                                <div class="spacer-xs"></div>
                            </div>
                        </div>
                        <!-- ACCORDIONS CONTENT -->
                        <div class="accordion-all-expand">
                            <div class="expand-all-button">
                                <div class="expand-all open">Розгорнути все</div>
                                <div class="expand-all close">Згорнути все</div>
                            </div>
                            <div class="accordion type-1">
                                <div class="accordion-item active">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/plan.svg')}}" alt="plan"></span>План туру<i></i></div>
                                    <div class="accordion-inner" style="display: block;">
                                        <div class="text text-md">
                                            <h4>1 день</h4>
                                            <p>Виїзд зі Львова (08:00) – Манява (екскурсія монастирем, обід та огляд водоспаду) – Делятин (огляд краєзнавчого музею) – Ясіня (поселення у готелі о 20:50, вечеря).</p>
                                            <h4>2 день</h4>
                                            <p>Сніданок і виїзд (08:00) – Ясіня (автомобільний підйом на Драгобрат, підйом канатно-крісельною дорогою на вершину Стіг, автомобільний переїзд до гірського озера Герашаска) – Яблуниця (відпочинок та майстер-класи на Полонині «Перці») – Львів (повернення до 23:00).</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/places.svg')}}" alt="places"></span>Місця<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">Манява<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_2.jpg')}}" alt="img 2" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_3.jpg')}}" alt="img 3" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_4.jpg')}}" alt="img 4" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_5.jpg')}}" alt="img 5" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_2.jpg')}}" alt="img 2" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_3.jpg')}}" alt="img 3" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_4.jpg')}}" alt="img 4" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_5.jpg')}}" alt="img 5" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="load-more-wrapp">
                                                        <div class="text text-md">
                                                            <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            <p>Неподалік від скита знаходиться «Манявський водоспад», який є одним із найгарніших і найвищих в українських Карпатах. Він прорізає тверді ґорґанські породи, а вода падає з висоти біля 20 метрів.</p>
                                                        </div>
                                                        <div class="more-info">
                                                            <div class="text text-md">
                                                                <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="spacer-xs"></div>
                                                            <div class="show-more">
                                                                <span>Читати більше</span>
                                                                <span>Сховати текст</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Делятин<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_1.jpg')}}" alt="img 1" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_3.jpg')}}" alt="img 3" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_4.jpg')}}" alt="img 4" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="load-more-wrapp">
                                                        <div class="text text-md">
                                                            <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            <p>Неподалік від скита знаходиться «Манявський водоспад», який є одним із найгарніших і найвищих в українських Карпатах. Він прорізає тверді ґорґанські породи, а вода падає з висоти біля 20 метрів.</p>
                                                        </div>
                                                        <div class="spacer-xs"></div>
                                                        <div class="more-info">
                                                            <div class="text text-md">
                                                                <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            </div>
                                                            <div class="spacer-xs"></div>
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="show-more">
                                                                <span>Читати більше</span>
                                                                <span>Сховати текст</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Драгобрат<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_2.jpg')}}" alt="img 2" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_3.jpg')}}" alt="img 3" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_4.jpg')}}" alt="img 4" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_5.jpg')}}" alt="img 5" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="load-more-wrapp">
                                                        <div class="text text-md">
                                                            <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            <p>Неподалік від скита знаходиться «Манявський водоспад», який є одним із найгарніших і найвищих в українських Карпатах. Він прорізає тверді ґорґанські породи, а вода падає з висоти біля 20 метрів.</p>
                                                        </div>
                                                        <div class="spacer-xs"></div>
                                                        <div class="more-info">
                                                            <div class="text text-md">
                                                                <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            </div>
                                                            <div class="spacer-xs"></div>
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="show-more">
                                                                <span>Читати більше</span>
                                                                <span>Сховати текст</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Яблуниця<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_2.jpg')}}" alt="img 2" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_3.jpg')}}" alt="img 3" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="load-more-wrapp">
                                                        <div class="text text-md">
                                                            <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            <p>Неподалік від скита знаходиться «Манявський водоспад», який є одним із найгарніших і найвищих в українських Карпатах. Він прорізає тверді ґорґанські породи, а вода падає з висоти біля 20 метрів.</p>
                                                        </div>
                                                        <div class="spacer-xs"></div>
                                                        <div class="more-info">
                                                            <div class="text text-md">
                                                                <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                                                            </div>
                                                            <div class="spacer-xs"></div>
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="show-more">
                                                                <span>Читати більше</span>
                                                                <span>Сховати текст</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/schedule.svg')}}" alt="schedule"></span>Розклад<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="calendar-header-center">
                                            <span class="text-sm">10+ місць</span>
                                            <span class="text-sm">2 — 10 місць</span>
                                            <span class="text-sm">Немає місць</span>
                                        </div>
                                        <div class="schedule">
                                            <div class="schedule-header">
                                                <span class="text-sm">Дати виїзду та повернення</span>
                                                <span class="text-sm">Вартість</span>
                                            </div>

                                            <div class="schedule-row still-have">
                                                <span class="text">Сб - Нд, 16 - 17.11.2019</span>
                                                <div>
                                                    <span class="text text-medium">95 грн.</span>
                                                    <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                                </div>
                                                <a href="order-client-1.php" class="btn type-1">Замовити</a>
                                            </div>

                                            <div class="schedule-row have-a-lot">
                                                <span class="text">Нд - Ср, 17 - 20.11.2019</span>
                                                <div>
                                                    <span class="text text-medium">95 грн.</span>
                                                    <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                                </div>
                                                <a href="order-client-1.php" class="btn type-1">Замовити</a>
                                            </div>

                                            <div class="schedule-row no-have">
                                                <span class="text">Пт - Нд, 20 - 22.11.2019</span>
                                                <div>
                                                    <span class="text text-medium">95 грн.</span>
                                                    <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                                </div>
                                                <a href="order-client-1.php" class="btn type-1">Замовити</a>
                                            </div>
                                        </div>
                                        <div class="spacer-xs"></div>
                                        <div class="text-center">
                                            <span class="btn type-2">Показати ще</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/wallet.svg')}}" alt="wallet"></span>Фінанси<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">У вартість туру входить<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <ul>
                                                            <li>проїзд автобусом туристичного класу,</li>
                                                            <li>проживання,</li>
                                                            <li>супровід гіда-екскурсовода,</li>
                                                            <li>екскурсійне обслуговування в туристичних об’єктах,</li>
                                                            <li>страхування на час подорожі.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">У вартість не входять і додатково оплачуються<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <ul>
                                                            <li>супровід гіда-екскурсовода,</li>
                                                            <li>екскурсійне обслуговування в туристичних об’єктах,</li>
                                                            <li>страхування на час подорожі.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Знижки<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="text text-md">
                                                        <ul>
                                                            <li>супровід гіда-екскурсовода,</li>
                                                            <li>екскурсійне обслуговування в туристичних об’єктах,</li>
                                                            <li>супровід гіда-екскурсовода,</li>
                                                            <li>екскурсійне обслуговування в туристичних об’єктах,</li>
                                                            <li>страхування на час подорожі.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/tickets.svg')}}" alt="tickets"></span>Вхідні квитки<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="tickets text text-md">
                                            <p><b>Палац шенборна:</b> Загальний - 15 грн., школярі - 10грн.</p>
                                        </div>

                                        <div class="tickets text text-md">
                                            <p><b>Мукачівський замок:</b> Загальний - 40 грн., студенти і пенсіонери - 30 грн., учні до 14 років - 20грн.</p>
                                        </div>

                                        <div class="tickets text text-md">
                                            <p><b>Новий термальний басейн "Жайворонок" у Береговому:</b> Загальний - 200 грн. (в тому числі оренда шафки), пенсіонери за віком - 150 грн., діти від 120 до 150 см - 100 грн., діти до 120 см та йчасники АТО - безкоштовно</p>
                                        </div>

                                        <div class="tickets text text-md">
                                            <p><b>Дегустація вин:</b> 60 грн., екскурсія без споживання вина - 30грн.</p>
                                        </div>

                                        <div class="tickets text text-md">
                                            <p><b>Водоспад Шипіт:</b> Загальний, пенсійний, студенський - 10 грн., учні - 5 грн.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/axe.svg')}}" alt="axe"></span>Гуцульська забава<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="text text-md">
                                            <p>На Ваш розсуд, більшість турфірм працює з нами без договору. Якщо Ви хочете його підписати, то ми на Вашу електронну пошту вишлемо наш типовий зразок, в який Ви вносите свої реквізити, підписуєте і пропечатуєте його, а потім надсилаєте паперовий варіант нам на пошту. Ми отримуємо підписуємо, пропечатуємо і висилаємо Вам Ваш примірник.</p>
                                            <p>На Ваш розсуд, більшість турфірм працює з нами без договору. Якщо Ви хочете його підписати, то ми на Вашу електронну пошту вишлемо наш типовий зразок, в який Ви вносите свої реквізити, підписуєте і пропечатуєте його, а потім надсилаєте паперовий варіант нам на пошту. Ми отримуємо підписуємо, пропечатуємо і висилаємо Вам Ваш примірник.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/keys.svg')}}" alt="keys"></span>Проживання<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">Садиби зеленого туризму Берегівського р-ну (1-2-3 ніч)<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"loop": true, "lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/img_6.jpg')}}" alt="img 6">
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text text-md">
                                                        <p>Затишні садиби сільського туризму Берегівського району з вигодами, номери: 2-х і 3-х місні.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Садиби зеленого туризму Верховинського р-ну (4-5 ніч)<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="swiper-entry">
                                                        <div class="swiper-button-prev">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-button-next">
                                                            <i></i>
                                                        </div>
                                                        <div class="swiper-container" data-options='{"loop": true, "lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                            <div class="swiper-wrapper lightbox-wrap">
                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="swiper-slide">
                                                                    <div class="img zoom">
                                                                        <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                        <div class="swiper-lazy-preloader"></div>
                                                                        <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="only-mobile swiper-pagination"></div>
                                                    </div>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text text-md">
                                                        <p>Затишні садиби сільського туризму Берегівського району з вигодами, номери: 2-х і 3-х місні.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/meal.svg')}}" alt="meal"></span>Харчування<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">1-й день<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="accordion type-3">
                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Сніданок<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Обід<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Вечеря<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">2-й день<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="accordion type-3">
                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Сніданок<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Обід<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Вечеря<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">3-й день<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="accordion type-3">
                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Сніданок<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Обід<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Вечеря<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="swiper-entry">
                                                                    <div class="swiper-button-prev">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-button-next">
                                                                        <i></i>
                                                                    </div>
                                                                    <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}}}'>
                                                                        <div class="swiper-wrapper lightbox-wrap">
                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="swiper-slide">
                                                                                <div class="img zoom">
                                                                                    <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                                    <div class="swiper-lazy-preloader"></div>
                                                                                    <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="only-mobile swiper-pagination"></div>
                                                                </div>
                                                                <div class="spacer-xs"></div>
                                                                <div class="text">
                                                                    <p>Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок. Можна поснідати вдома або взяти з собою канапки, щоб перекусити під час стоянок.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/calculator.svg')}}" alt="calculator"></span>Калькулятор туру<i></i></div>
                                    <div class="accordion-inner">
                                        <form action="/" class="calc-form">
                                            <div class="text-sm">Дата виїзду*</div>
                                            <div class="single-datepicker">
                                                <div class="datepicker-input">
                                                    <span class="datepicker-placeholder">Сб - Нд, 16 - 17.11.2019</span>
                                                    <!-- <div class="datepicker-toggle">
                                                        <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб з інвалідністю та інших пільгових категорій.</p>
                                            </div>
                                            <div class="calc">
                                                <div class="calc-header">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="all-inclusive">
                                                        <span>Все включено</span>
                                                    </label>
                                                </div>

                                                <div class="calc-rows-wrap">
                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="tour">
                                                            <span>Тур</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="895">895</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="tickets-shenborn">
                                                            <span>Вхідні квитки в палац Шенборна</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="20">20</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="tickets-mukatchevo">
                                                            <span>Вхідні квитки в Мукачівський замок</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="50">50</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="tickets-pool">
                                                            <span>Вхідні квитки в басейн «Жайворонок»</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="200">200</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="safe">
                                                            <span>Оренда шафки</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="20">20</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="vine">
                                                            <span>Дегустація вин</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="60">60</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="cheese-vine">
                                                            <span>Дегустація трьох сортів сиру з вином</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="50">50</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="waterfall">
                                                            <span>Водоспад Шипіт</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="10">10</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="synevyr">
                                                            <span>Озеро Синевир</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="25">25</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="lunch">
                                                            <span>Обід у 1-й день</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="90">90</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="dinner">
                                                            <span>Вечеря у 1-й день</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="80">80</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="breakfast">
                                                            <span>Сніданок у 2-й день</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="55">55</span> грн</span>
                                                    </div>

                                                    <div class="calc-row">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="second-lunch">
                                                            <span>Обід у 2-й день</span>
                                                        </label>
                                                        <div class="number-input">
                                                            <div class="number-input-btns">
                                                                <button type="button" class="decrement"></button>
                                                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                                                <button type="button" class="increment"></button>
                                                            </div>
                                                        </div>
                                                        <span class="text-md"><span class="calc-item-price" data-price="110">110</span> грн</span>
                                                    </div>
                                                </div>
                                                <div class="calc-footer">
                                                    <span class="text-sm">Загальна сума: <span class="calc-total-price">0</span> <sup>грн</sup></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/faq.svg')}}" alt="faq"></span>Питання та відповіді<i></i></div>
                                    <div class="accordion-inner">
                                        <div class="accordion type-2">
                                            <div class="accordion-item">
                                                <div class="accordion-title">Загальні питання<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="accordion type-3">
                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Чи потрібно підписувати договір?<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>За бажанням чи потреби</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Як скасувати тур<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб з інвалідністю та інших пільгових категорій.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Скільки часу очікувати на відповідь менеджера<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб з інвалідністю та інших пільгових категорій.</p>
                                                                    <p>Та інших пільгових категорій.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Питання щодо туру<i></i></div>
                                                <div class="accordion-inner">
                                                    <div class="accordion type-3">
                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Чи потрібно підписувати договір?<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>За бажанням чи потреби</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Як скасувати тур<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб з інвалідністю та інших пільгових категорій.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-title">Скільки часу очікувати на відповідь менеджера<i></i></div>
                                                            <div class="accordion-inner">
                                                                <div class="text">
                                                                    <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб з інвалідністю та інших пільгових категорій.</p>
                                                                    <p>Та інших пільгових категорій.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <div class="accordion-title">Задати питання<i></i></div>
                                                <div class="accordion-inner">
                                                    <form action="/" class="row">
                                                        <div class="col-md-6 col-12">
                                                            <label>
                                                                <i>Прізвище*</i>
                                                                <input type="text" name="surname" required>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <label>
                                                                <i>Ім’я*</i>
                                                                <input type="text" name="name" required>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <label>
                                                                <i>Email*</i>
                                                                <input type="text" name="email" required>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <label>
                                                                <i>Телефон</i>
                                                                <input type="tel" name="tel">
                                                            </label>
                                                        </div>

                                                        <div class="col-12">
                                                            <label>
                                                                <i>Ваш коментар*</i>
                                                                <textarea required></textarea>
                                                            </label>
                                                            <span class="btn type-1 open-popup" data-rel="thanks-popup">Надіслати</span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="spacer-xs"></div>
                                        <div class="review">
                                            <div class="review-header">
                                                <div class="review-img">
                                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}" alt="user">
                                                </div>
                                                <div class="review-title">
                                                    <span class="h4">Григоряш Вероніка</span>
                                                    <span class="text text-sm">22.11.2019</span>
                                                    <span class="text text-sm">13:09</span>
                                                    <span class="stars select-stars stars-selected">
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star-empty"></i>
													</span>
                                                    <span class="text">Відповісти</span>
                                                </div>
                                            </div>
                                            <div class="text text-md">
                                                <p>Доброго дня. Цікавить наступне питання. Чи можна підбирати учасників туру по ходу туру? І чи вплине це якимось чином на остаточну вартість?</p>
                                            </div>
                                        </div>
                                        <div class="load-more-wrapp">
                                            <div class="show-more active">
                                                <span>Приховати відповіді</span>
                                                <span>Показати відповіді</span>
                                            </div>
                                            <div class="more-info">
                                                <div class="spacer-xs"></div>
                                                <div class="review">
                                                    <div class="review-header">
                                                        <div class="review-img">
                                                            <span class="full-size h4">КП</span>
                                                        </div>
                                                        <div class="review-title">
                                                            <span class="h4">Кононієнко Петро</span>
                                                            <span class="text text-sm">22.11.2019</span>
                                                            <span class="text text-sm">12:20</span>
                                                            <span class="text">Відповісти</span>
                                                        </div>
                                                    </div>
                                                    <div class="text text-md">
                                                        <p><span class="label">Григоряш Вероніка</span> Доброго дня! Так, звісно. Остаточна сума в такому випадку обговорюється</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item" id="reviews-accordion">
                                    <div class="accordion-title"><span><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/rating.svg')}}" alt="rating"></span>Відгуки (26)<i></i></div>
                                    <div class="accordion-inner">
                                        <span class="btn btn-block-sm type-1 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
                                        <div class="spacer-xs"></div>
                                        <hr>
                                        <div class="spacer-xs"></div>
                                        <div class="review">
                                            <div class="review-header">
                                                <div class="review-img">
                                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}" alt="user">
                                                </div>
                                                <div class="review-title">
                                                    <span class="h4">Григоряш Вероніка</span>
                                                    <span class="text text-sm">22.11.2019</span>
                                                    <span class="text text-sm">18:55</span>
                                                    <span class="stars select-stars stars-selected">
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star-empty"></i>
													</span>
                                                    <span class="text">Відповісти</span>
                                                </div>
                                            </div>
                                            <div class="text text-md">
                                                <p>Гід: <b>Кононієнко Петро</b></p>
                                                <p>Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще! Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                                            </div>
                                            <div class="spacer-xs"></div>
                                            <div class="swiper-entry">
                                                <div class="swiper-container" data-options='{"lazy": true, "slidesPerView": 3, "spaceBetween": 15, "breakpoints": {"992": {"slidesPerView": 4, "spaceBetween": 22}, "1200": {"slidesPerView": 5, "spaceBetween": 22}}}'>
                                                    <div class="swiper-wrapper lightbox-wrap">
                                                        <div class="swiper-slide">
                                                            <div class="img zoom">
                                                                <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                <div class="swiper-lazy-preloader"></div>
                                                                <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                            </div>
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <div class="img zoom">
                                                                <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_7.jpg')}}" alt="img 7" class="swiper-lazy">
                                                                <div class="swiper-lazy-preloader"></div>
                                                                <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                            </div>
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <div class="img zoom">
                                                                <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_8.jpg')}}" alt="img 8" class="swiper-lazy">
                                                                <div class="swiper-lazy-preloader"></div>
                                                                <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                            </div>
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <div class="img zoom">
                                                                <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_9.jpg')}}" alt="img 9" class="swiper-lazy">
                                                                <div class="swiper-lazy-preloader"></div>
                                                                <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                            </div>
                                                        </div>

                                                        <div class="swiper-slide">
                                                            <div class="img zoom">
                                                                <img src="{{asset('/img/preloader.png')}}" data-src="{{asset('/img/img_6.jpg')}}" alt="img 6" class="swiper-lazy">
                                                                <div class="swiper-lazy-preloader"></div>
                                                                <div class="full-size open-popup" data-rel="gallery-popup"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-button-prev bottom-sm">
                                                    <i></i>
                                                </div>
                                                <div class="only-mobile swiper-pagination"></div>
                                                <div class="swiper-button-next bottom-sm">
                                                    <i></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="load-more-wrapp">
                                            <div class="show-more active">
                                                <span>Приховати відповіді</span>
                                                <span>Показати відповіді</span>
                                            </div>
                                            <div class="more-info">
                                                <div class="spacer-xs"></div>
                                                <div class="review">
                                                    <div class="review-header">
                                                        <div class="review-img">
                                                            <span class="full-size h4">КП</span>
                                                        </div>
                                                        <div class="review-title">
                                                            <span class="h4">Кононієнко Петро</span>
                                                            <span class="text text-sm">22.11.2019</span>
                                                            <span class="text text-sm">12:20</span>
                                                            <span class="text">Відповісти</span>
                                                        </div>
                                                    </div>
                                                    <div class="text text-md">
                                                        <p><span class="label">Григоряш Вероніка</span> Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще! Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="spacer-xs"></div>
                                        <hr>
                                        <div class="spacer-xs"></div>
                                        <div class="review">
                                            <div class="review-header">
                                                <div class="review-img">
                                                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}" alt="user">
                                                </div>
                                                <div class="review-title">
                                                    <span class="h4">Григоряш Вероніка</span>
                                                    <span class="text text-sm">22.11.2019</span>
                                                    <span class="text text-sm">18:55</span>
                                                    <span class="stars select-stars stars-selected">
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star"></i>
														<i class="select-icon icon-star-empty"></i>
													</span>
                                                    <span class="text">Відповісти</span>
                                                </div>
                                            </div>
                                            <div class="text text-md">
                                                <p>Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще! Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                                            </div>
                                        </div>
                                        <div class="load-more-wrapp">
                                            <div class="show-more active">
                                                <span>Приховати відповіді</span>
                                                <span>Показати відповіді</span>
                                            </div>
                                            <div class="more-info">
                                                <div class="spacer-xs"></div>
                                                <div class="review">
                                                    <div class="review-header">
                                                        <div class="review-img">
                                                            <span class="full-size h4">КП</span>
                                                        </div>
                                                        <div class="review-title">
                                                            <span class="h4">Кононієнко Петро</span>
                                                            <span class="text text-sm">22.11.2019</span>
                                                            <span class="text text-sm">12:20</span>
                                                            <span class="text">Відповісти</span>
                                                        </div>
                                                    </div>
                                                    <div class="text text-md">
                                                        <p><span class="label">Григоряш Вероніка</span> Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще! Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="spacer-xs"></div>
                                        <hr>
                                        <div class="spacer-xs"></div>
                                        <span class="btn btn-block-sm type-1 open-popup" data-rel="testimonial-popup">Залишити відгук</span>
                                    </div>
                                </div>
                            </div>
                            <div class="expand-all-button">
                                <div class="expand-all open">Розгорнути все</div>
                                <div class="expand-all close">Згорнути все</div>
                            </div>
                        </div>
                        <!-- ACCORDIONS CONTENT END -->
                    </div>
                    <!-- TOUR CONTENT END -->
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    @include('tour.includes.right-sidebar')

                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- THUMBS CAROUSEL -->
            @include('tour.includes.similar-carousel')
        <!-- THUMBS CAROUSEL END -->

        <!-- SEO TEXT -->
        @include('includes.regulations')
        <!-- SEO TEXT END -->
    </main>

@endsection


@push('popups')
    <div class="popup-content" data-rel="calendar-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1 calendar-popup">
            <div class="popup-header">
                <span class="h2 title text-medium">Оберіть дату проведення туру</span>
            </div>
            <div class="popup-align">
                <x-tour.calendar :filter="['tour_id'=>$tour->id, 'event_click'=>'order']" :viewChange="false" />
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
@endpush
