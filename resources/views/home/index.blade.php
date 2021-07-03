@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row short-distance mobile-reverse-content">
            <div class="col-xl-3 offset-xl-0 col-lg-8 offset-lg-2 col-12">
                <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
            </div>

            <div class="col-xl-9 col-12">
                <!-- BANNER CAROUSEL -->
                <section class="section">
                    <div class="tab-top-part active" data-tab="1">
                        <div class="banner-carousel">
                            <div class="swiper-entry">
                                <div class="banner-carousel-controls">
                                    <div class="swiper-button-prev">
                                        <i></i>
                                    </div>
                                    <div class="swiper-pagination light"></div>
                                    <div class="swiper-button-next">
                                        <i></i>
                                    </div>
                                </div>
                                <div class="swiper-container" data-options='{
										"autoHeight": true,
										"parallax": true,
										"speed": 900,
										"loop": true,
										"lazy": true,
										"autoplay": {
											"delay": 5000
										},
										"breakpoints": {
											"1200": {
												"autoplay": {
													"delay": 5000
												}
											},
											"0": {
												"autoplay": false
											}
										}
									}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img.jpg')}}" alt="banner img" data-swiper-parallax="30%" class="swiper-lazy">
                                            <div class="swiper-lazy-preloader"></div>
                                            <span class="label hit-sales">Хіт продажів</span>
                                            <div class="full-size">
                                                <div>
                                                    <h2 class="h1 title light">
                                                        <a href="#">Сиро-винний тур Закарпатським та Прикарпатським краями</a>
                                                    </h2>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text-md light">
                                                        <span>палац Шенборна, Мукачівський замок, басейн і вино в Берегово, Селиська сироварня, озеро Синевир, водоспад Шипіт</span>
                                                        <a href="#" class="btn type-3 btn-more light">Більше</a>
                                                    </div>
                                                </div>

                                                <div>
                                                    <span class="h1">745 <span class="text light">/ грн</span></span>
                                                    <span class="text-sm light">вартість з 1 особи</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img.jpg')}}" alt="banner img" data-swiper-parallax="30%" class="swiper-lazy">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="full-size">
                                                <div>
                                                    <h2 class="h1 title light">
                                                        <a href="#">Сиро-винний тур Закарпатським та Прикарпатським краями</a>
                                                    </h2>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text-md light">
                                                        <span>палац Шенборна, Мукачівський замок, басейн і вино в Берегово, Селиська сироварня, озеро Синевир, водоспад Шипіт</span>
                                                        <a href="#" class="btn type-3 btn-more light">Більше</a>
                                                    </div>
                                                </div>

                                                <div>
                                                    <span class="h1">745 <span class="text light">/ грн</span></span>
                                                    <span class="text-sm light">вартість з 1 особи</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img.jpg')}}" alt="banner img" data-swiper-parallax="30%" class="swiper-lazy">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="full-size">
                                                <div>
                                                    <h2 class="h1 title light">
                                                        <a href="#">Сиро-винний тур Закарпатським та Прикарпатським краями</a>
                                                    </h2>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text-md light">
                                                        <span>палац Шенборна, Мукачівський замок, басейн і вино в Берегово, Селиська сироварня, озеро Синевир, водоспад Шипіт</span>
                                                        <a href="#" class="btn type-3 btn-more light">Більше</a>
                                                    </div>
                                                </div>

                                                <div>
                                                    <span class="h1">745 <span class="text light">/ грн</span></span>
                                                    <span class="text-sm light">вартість з 1 особи</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img.jpg')}}" alt="banner img" data-swiper-parallax="30%" class="swiper-lazy">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="full-size">
                                                <div>
                                                    <h2 class="h1 title light">
                                                        <a href="#">Сиро-винний тур Закарпатським та Прикарпатським краями</a>
                                                    </h2>
                                                    <div class="spacer-xs"></div>
                                                    <div class="text-md light">
                                                        <span>палац Шенборна, Мукачівський замок, басейн і вино в Берегово, Селиська сироварня, озеро Синевир, водоспад Шипіт</span>
                                                        <a href="#" class="btn type-3 btn-more light">Більше</a>
                                                    </div>
                                                </div>

                                                <div>
                                                    <span class="h1">745 <span class="text light">/ грн</span></span>
                                                    <span class="text-sm light">вартість з 1 особи</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                </section>
                <!-- BANNER CAROUSEL END -->

                <!-- MOBILE BUTTONS BAR -->
                <div class="only-pad-mobile">
                    <div class="row short-distance">
                        <div class="col-md-4 col-12 only-pad">
                            <span class="btn type-4 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</span>
                        </div>

                        <div class="col-md-4 col-12 only-pad">
                            <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/tours-scedule-dark.svg')}}" alt="tours scedule dark">Завантажити розклади турів</a>
                        </div>

                        <div class="col-md-4 col-12">
                            <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/filter-dark.svg')}}" alt="filter-dark">Підбір туру</span>
                        </div>
                    </div>
                    <div class="spacer-sm"></div>
                </div>
                <!-- MOBILE BUTTONS BAR END -->

                <div class="tabs">
                    <div class="tab-nav">
                        <ul class="tab-toggle">
                            <li class="tab-caption active">
                                <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V1zM8 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V9zM0 9a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V9zM0 1a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H1a1 1 0 01-1-1V1z"/></svg>
                                <span>Галерея</span>
                            </li>

                            <li class="tab-caption only-desktop">
                                <svg width="16" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 1a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 1a1 1 0 112 0 1 1 0 01-2 0zM4 6a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 6a1 1 0 112 0 1 1 0 01-2 0zM4 11a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM0 11a1 1 0 112 0 1 1 0 01-2 0z"/></svg>
                                <span>Список</span>
                            </li>

                            <li class="tab-caption calendar-init">
                                <svg width="15" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x=".75" y="2.75" width="13.5" height="13.5" rx="1.25" stroke-width="1.5"/><path d="M3 8h2v2H3V8zM6.5 8h2v2h-2V8zM10 8h2v2h-2V8zM3 12h2v2H3v-2zM6.5 12h2v2h-2v-2zM10 12h2v2h-2v-2zM3.25 2.5a.75.75 0 001.5 0h-1.5zM4.75 1a.75.75 0 00-1.5 0h1.5zm5.5 1.5a.75.75 0 001.5 0h-1.5zm1.5-1.5a.75.75 0 00-1.5 0h1.5zM0 6.75h15v-1.5H0v1.5zM4.75 2.5V1h-1.5v1.5h1.5zm7 0V1h-1.5v1.5h1.5z"/></svg>
                                <span>Календар</span>
                            </li>
                        </ul>
                    </div>
                    <div class="tabs-wrap">
                        <!-- TAB #1 -->
                        <div class="tab active">
                            <div class="spacer-xs"></div>
                            <form action="/" class="filter-result-bar">
                                <span class="title h3 only-desktop">Доступно 40 турів</span>
                                <label class="only-desktop">
                                    <span class="text">Показати тури</span>
                                    <select>
                                        <option value="amount-1" selected>12</option>
                                        <option value="amount-2">24</option>
                                        <option value="amount-3">Всі тури</option>
                                    </select>
                                </label>
                                <label>
                                    <span class="text">Сортувати за</span>
                                    <select>
                                        <option value="sort-option-1" selected>Від найдешевшого</option>
                                        <option value="sort-option-2">Від найдорожчого</option>
                                        <option value="sort-option-3">Від новішого</option>
                                        <option value="sort-option-4">Від старішого</option>
                                    </select>
                                </label>
                            </form>
                            <div class="spacer-xs"></div>
                            <!-- THUMBS -->
                            <div class="thumb-wrap row">
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_1.jpg')}}" alt="tour 1">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Манява — Драгобрат — полонина Перці</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_2.jpg')}}" alt="tour 2">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Тур-відпустка «6 днів у замових Карпатах»</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">14 відгуків</span>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">0 <span class="tooltip-wrap black"><span class="tooltip text text-sm light">0 людей</span></span></span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>2595</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label hit-sales">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_3.jpg')}}" alt="tour 3">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Сиро-Винний тур Закарпатським та Прикарпатським замками</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                                <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_1.jpg')}}" alt="tour 1">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Манява — Драгобрат — полонина Перці</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_2.jpg')}}" alt="tour 2">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Тур-відпустка «6 днів у замових Карпатах»</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">14 відгуків</span>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">0 <span class="tooltip-wrap black"><span class="tooltip text text-sm light">0 людей</span></span></span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>2595</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label hit-sales">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_3.jpg')}}" alt="tour 3">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Сиро-Винний тур Закарпатським та Прикарпатським замками</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_1.jpg')}}" alt="tour 1">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Манява — Драгобрат — полонина Перці</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            </div>
                                            <hr>
                                            <div class="text text-center">Хочуть повторити тур — <b>12 осіб</b></div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_2.jpg')}}" alt="tour 2">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Тур-відпустка «6 днів у замових Карпатах»</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">14 відгуків</span>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">0 <span class="tooltip-wrap black"><span class="tooltip text text-sm light">0 людей</span></span></span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>2595</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="thumb">
                                        <div class="thumb-img">
                                            <div class="label hit-sales">новинка</div>
                                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_3.jpg')}}" alt="tour 3">
                                            <a href="#" class="full-size"></a>
                                        </div>
                                        <div class="thumb-content">
                                            <div class="title h3">
                                                <a href="#">Сиро-Винний тур Закарпатським та Прикарпатським замками</a>
                                            </div>
                                            <span class="stars select-stars stars-selected">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
												</span>
                                            <div class="datepicker-input">
                                                <select>
                                                    <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                    <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                                </select>
                                            </div>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2д / 1н</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                            <div class="thumb-price">
                                                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            </div>
                                            <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                        </div>
                                        <div class="thumb-desc text">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn btn-read-more">Більше</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="spacer-xs"></div>
                                    <div class="text-center">
                                        <span class="btn type-2">Показати ще 12</span>
                                    </div>
                                </div>
                            </div>
                            <!-- THUMBS END -->
                        </div>
                        <!-- TAB #1 END -->

                        <!-- TAB #2 -->
                        <div class="tab only-desktop">
                            <div class="spacer-xs"></div>
                            <form action="/" class="filter-result-bar">
                                <span class="title h3 only-desktop">Доступно 40 турів</span>
                                <label class="only-desktop">
                                    <span class="text">Показати тури</span>
                                    <select>
                                        <option value="amount-1" selected>12</option>
                                        <option value="amount-2">24</option>
                                        <option value="amount-3">Всі тури</option>
                                    </select>
                                </label>
                                <label>
                                    <span class="text">Сортувати за</span>
                                    <select>
                                        <option value="sort-option-1" selected>Від найдешевшого</option>
                                        <option value="sort-option-2">Від найдорожчого</option>
                                        <option value="sort-option-3">Від новішого</option>
                                        <option value="sort-option-4">Від старішого</option>
                                    </select>
                                </label>
                            </form>
                            <div class="spacer-xs"></div>

                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_1.jpg')}}" alt="tour 3">
                                    <div class="label hit-sales">Хіт продажів</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">14 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">14 відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2 год. 30 хв.</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_2.jpg')}}" alt="tour 3">
                                    <div class="label">Новінка</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">7 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">7 відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">6 год.</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_3.jpg')}}" alt="tour 3">
                                    <div class="label">Новінка</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-stary"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">7 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">Немає відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2 дні / 1 ніч</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_1.jpg')}}" alt="tour 3">
                                    <div class="label hit-sales">Хіт продажів</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">14 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">7 відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2 год. 30 хв.</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_2.jpg')}}" alt="tour 3">
                                    <div class="label">Новінка</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">7 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">14 відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">6 год.</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb-img">
                                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/tour_3.jpg')}}" alt="tour 3">
                                    <div class="label">Новінка</div>
                                    <a href="#" class="full-size"></a>
                                </div>
                                <div class="d-flex align-items-start item-cnt">
                                    <div class="thumb-content">
                                        <div class="title h4">
                                            <a href="#">Манява — Драгобрат — полонина Перці — Яремче — Драгобрат — Драгобрат — полонина Перці</a>
                                        </div>
                                        <span class="stars select-stars stars-selected d-none d-lg-block">
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-stary"></i>
												<i class="select-icon icon-star"></i>
												<i class="select-icon icon-star-empty"></i>
												<i class="select-icon icon-star-empty"></i>
												<span class="text">7 відгуків</span>
											</span>
                                        <div class="text desc">
                                            <p>Засніжені гори, забави, замки, вина, термальні басейни, водоспади, давні храми; все найкраще, що є в зимових горах чекає на Вас… <a href="#" class="btn  btn-read-more text-bold">Більше</a></p>
                                        </div>
                                    </div>
                                    <div class="thumb-content">
                                        <div class="datepicker-input d-none d-lg-block">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
												<span class="stars select-stars stars-selected d-block d-lg-none">
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<i class="select-icon icon-star-empty"></i>
													<span class="text">Немає відгуків</span>
												</span>
                                            <div class="thumb-info">
                                                <span class="thumb-info-time text">2 дні / 1 ніч</span>
                                                <span class="thumb-info-people text">10+</span>
                                            </div>
                                        </div>
                                        <div class="datepicker-input d-block d-lg-none">
                                            <select>
                                                <option value="1">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="2">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="3">Сб - Нд, 16 - 17.11.2019</option>
                                                <option value="4">Сб - Нд, 16 - 17.11.2019</option>
                                            </select>
                                        </div>
                                        <div class="thumb-price">
                                            <span class="text">Ціна:<span>895</span><i>грн</i></span>
                                            <span class="discount">20 грн.</span>
                                        </div>
                                        <a href="#" class="btn type-1 btn-block">Замовити Тур</a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="spacer-xs"></div>
                                <span class="btn type-2">Показати ще 12</span>
                            </div>
                        </div>
                        <!-- TAB #2 END -->

                        <!-- TAB #3 -->
                        <div class="tab">
                            <div class="spacer-xs"></div>
                            <div id="calendar">
                                <div class="calendar-header-center">
                                    <span class="text-sm">10+ місць</span>
                                    <span class="text-sm">2 — 10 місць</span>
                                    <span class="text-sm">Немає місць</span>
                                    <span class="text">Вигляд</span>
                                </div>
                                <div class="calendar-footer-center">
                                    <span class="text-sm">10+ місць</span>
                                    <span class="text-sm">2 — 10 місць</span>
                                    <span class="text-sm">Немає місць</span>
                                    <span class="text">Вигляд</span>
                                </div>
                            </div>
                        </div>
                        <!-- TAB #3 END -->
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-xs"></div>
    </div>

    <!-- ACHIEVEMENTS SECTION -->
    <section class="partners-slider section">
        <div class="container">
            <hr class="only-desktop">
            <div class="spacer spacer-xs only-desktop"></div>
            <h2 class="title h1 text-center">Досягнення</h2>
            <div class="spacer-xs"></div>
            <div class="swiper-entry">
                <div class="swiper-container" data-options='{
						"loop": true,
						"lazy": true,
						"speed": 700,
						"autoHeight": true,
						"slidesPerView": 2,
						"slidesPerGroup": 2,
						"spaceBetween": 30,
						"breakpoints": {
							"768": {
								"slidesPerView": 3,
								"slidesPerGroup": 3
							},
							"1200": {
								"slidesPerView": 4,
								"slidesPerGroup": 4
							}
						}
					}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/pie-chart.svg')}}" alt="pie chart" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p><span>6,4%</span> ринку внутрішнього туризму</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/signpost.svg')}}" alt="signpost" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p>Більше <span>197 000</span> туристів</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/tourist.svg')}}" alt="tourist" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p><span>282</span> Авторських турів та екскурсій</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/network.svg')}}" alt="network" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p>Партнерство з <span>560</span> турагентами</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/pie-chart.svg')}}" alt="pie chart" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p><span>6,4%</span> ринку внутрішнього туризму</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/signpost.svg')}}" alt="signpost" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p>Більше <span>197 000</span> туристів</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/tourist.svg')}}" alt="tourist" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p><span>282</span> Авторських турів та екскурсій</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('icon/network.svg')}}" alt="network" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                            <div class="text text-bold text-center">
                                <p>Партнерство з <span>560</span> турагентами</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"><i></i></div>
                <div class="swiper-pagination relative"></div>
                <div class="swiper-button-next"><i></i></div>
            </div>
        </div>
        <div class="spacer spacer-xs"></div>
    </section>
    <!-- ACHIEVEMENTS SECTION END -->

    <!-- OUR CLIENTS -->
    <section class="partners-slider section">
        <div class="container">
            <hr class="only-desktop">
            <div class="spacer spacer-xs only-desktop"></div>
            <h2 class="title h1 text-center">Наші клієнти</h2>
            <div class="spacer-xs"></div>
            <div class="swiper-entry">
                <div class="swiper-container" data-options='{
						"loop": true,
						"lazy": true,
						"speed": 700,
						"autoHeight": true,
						"slidesPerView": 2,
						"slidesPerGroup": 2,
						"spaceBetween": 30,
						"breakpoints": {
							"576": {
								"slidesPerView": 3,
								"slidesPerGroup": 3
							},
							"768": {
								"slidesPerView": 4,
								"slidesPerGroup": 4
							},
							"1400": {
								"slidesPerView": 5,
								"slidesPerGroup": 5
							},
							"1800": {
								"slidesPerView": 6,
								"slidesPerGroup": 6
							}
						}
					}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_1.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_2.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_3.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_4.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_5.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_6.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_3.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="{{asset('img/logo_4.png')}}" alt="partner logo" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"><i></i></div>
                <div class="swiper-pagination relative"></div>
                <div class="swiper-button-next"><i></i></div>
            </div>
        </div>
        <div class="spacer spacer-xs"></div>
    </section>
    <!-- OUR CLIENTS END -->

    <!-- SEO TEXT -->
    <div class="section only-desktop">
        <div class="container">
            <hr>
            <div class="spacer spacer-sm"></div>
            <div class="seo-text load-more-wrapp">
                <div class="row">
                    <div class="col-xl-8 offset-xl-2 col-12">
                        <div class="title h2">Правила замовлення турів</div>
                        <div class="spacer-xs"></div>
                        <div class="text text-md">
                            <p>Замовлення туру відбувається у три основні етапи: запит, бронювання (підтвердження), оплата. У випадку відсутності місць пропонується додатковий проміжний етап між запитом та бронюванням: резерв (включення до списку очікування). Запит на наявність вільних місць в турах можна подати через сайт.</p>
                        </div>
                        <div class="more-info">
                            <div class="text text-md">
                                <p>На березі річки Манявки розташований один із найбільших духовних центрів Західної України – «Український Афон». Історико-архітектурний заповідник «Скит Манявський» був заснований як монастир-скит у мальовничому куточку Карпат вихідцем з Афону Йовом Княгинецьким (1606р.). У часи найбільшого розквіту скитові підпорядковувалося 556 монастирів Східної Європи. Зараз тут Манявський Хресто-Воздвиженський чоловічий монастир УПЦ КП. Віруючі можуть помолитися в багатьох храмах, а також відвідати «Блаженний камінь» – цілюще джерело, яке б’є з каменя-пісковика і вода якого має такі властивості, як води Люрду.</p>
                            </div>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="show-more">
                            <span>Читати більше</span>
                            <span>Сховати текст</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer spacer-lg"></div>
    </div>
    <!-- SEO TEXT END -->
@endsection
