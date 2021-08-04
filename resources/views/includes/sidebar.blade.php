<div class="left-sidebar">

    <div class="left-sidebar-inner">
        <span class="btn type-4 arrow-right only-desktop"><svg width="30" height="27" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M23 7.456c0 7.14-5.585 12.502-7.422 14.073a.879.879 0 01-1.156 0C12.585 19.958 7 14.595 7 7.456 7 3.338 10.582 0 15 0s8 3.338 8 7.456zM15 11a3 3 0 100-6 3 3 0 000 6z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15.578 21.529C17.415 19.958 23 14.595 23 7.456 23 3.338 19.418 0 15 0S7 3.338 7 7.456c0 7.14 5.585 12.502 7.422 14.073a.879.879 0 001.156 0zM15 11a3 3 0 100-6 3 3 0 000 6z"/><path d="M25 14h.61a.5.5 0 01.485.379l2.594 10.379A1 1 0 0127.72 26H2.281a1 1 0 01-.97-1.242l2.594-10.38A.5.5 0 014.39 14H5" class="only-stroke" stroke-width="2" stroke-linecap="round"/></svg>Замовити тур</span>
        <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right only-desktop"><svg width="30" height="28" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16.735.015a.638.638 0 01.53.121.602.602 0 01.235.477V2.44h11.875c.345 0 .625.273.625.609v21.91c0 .335-.28.608-.625.608H17.5v1.826a.623.623 0 01-.72.601L.53 25.558a.614.614 0 01-.53-.6V4.264a.612.612 0 01.485-.599L16.735.015zM28.75 6.09V3.656H22.5v2.435h6.25zM22.5 7.308h6.25v2.434H22.5V7.308zM21.25 6.09V3.656H17.5v2.435h3.75zM17.5 7.308h3.75v2.434H17.5V7.308zm11.25 3.652H22.5v2.434h6.25V10.96zm-7.5 0H17.5v2.434h3.75V10.96zm1.25 3.651h6.25v2.434H22.5v-2.434zm-5 0h3.75v2.434H17.5v-2.434zm11.25 3.652H22.5v2.434h6.25v-2.434zm-7.5 0H17.5v2.434h3.75v-2.434zm1.25 3.651h6.25v2.434H22.5v-2.434zm-5 0h3.75v2.434H17.5v-2.434zM5.001 18.87c0 .336.279.61.624.61a.629.629 0 00.531-.287L8.75 15.15l2.595 4.043a.638.638 0 00.86.194.6.6 0 00.2-.838l-2.918-4.547 2.92-4.548a.6.6 0 00-.206-.865.634.634 0 00-.855.221L8.75 12.856 6.155 8.812a.635.635 0 00-.889-.2.599.599 0 00-.171.844l2.919 4.548-2.918 4.545a.597.597 0 00-.095.321z"/></svg>Завантажити розклади турів</a>
        <div id="tour-selection-dropdown" class="sidebar-item selection-tour notice">
            <div class="top-part">
                <div class="title h3 light title-icon"><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/filter.svg')}}" alt="filter">Підбір туру</div>
                <div class="btn-close light">
                    <span></span>
                </div>
            </div>
            <div class="bottom-part">
                <form action="/">
                    <div class="double-datepicker">
                        <div class="datepicker-input date-departure">
                            <span class="datepicker-placeholder">Дата виїзду</span>
                            <div class="datepicker-toggle">
                                <div class="datepicker-here" data-language="uk"></div>
                            </div>
                        </div>

                        <div class="datepicker-input date-arrival">
                            <span class="datepicker-placeholder">Дата Приїзду</span>
                            <div class="datepicker-toggle">
                                <div class="datepicker-here" data-language="uk"></div>
                            </div>
                        </div>
                    </div>

                    <div class="range">
                        <label for="days-amount">Тривалість днів</label>
                        <input type="text" id="days-amount" readonly>
                        <div class="slider-range" data-min="1" data-max="14" data-values="[1, 14]"></div>
                        <div class="text">
                            <span>від <span class="range-min">1</span></span>
                            <span>до <span class="range-max">14</span></span>
                        </div>
                    </div>

                    <div class="range">
                        <label for="price">Вартість, грн</label>
                        <input type="text" id="price" readonly>
                        <div class="slider-range" data-min="0" data-max="3000" data-values="[0, 3000]"></div>
                        <div class="text">
                            <span>від <span class="range-min">0</span></span>
                            <span>до <span class="range-max">3000</span></span>
                        </div>
                    </div>

                    <select name="direction">
                        <option value="location_0" selected disabled>Напрямок</option>
                        <option value="location_1">Напрямок 1</option>
                        <option value="location_2">Напрямок 2</option>
                        <option value="location_3">Напрямок 3</option>
                        <option value="location_4">Напрямок 4</option>
                        <option value="location_5">Напрямок 5</option>
                        <option value="location_6">Напрямок 6</option>
                        <option value="location_7">Напрямок 7</option>
                        <option value="location_8">Напрямок 8</option>
                    </select>

                    <select name="type">
                        <option value="type_0" selected disabled>Тип</option>
                        <option value="type_1">Тип 1</option>
                        <option value="type_2">Тип 2</option>
                        <option value="type_3">Тип 3</option>
                        <option value="type_4">Тип 4</option>
                        <option value="type_5">Тип 5</option>
                        <option value="type_6">Тип 6</option>
                    </select>

                    <select name="topic">
                        <option value="0" selected disabled>Тематика</option>
                        <option value="topic_1">Тематика 1</option>
                        <option value="topic_2">Тематика 2</option>
                        <option value="topic_3">Тематика 3</option>
                        <option value="topic_4">Тематика 4</option>
                        <option value="topic_5">Тематика 5</option>
                        <option value="topic_6">Тематика 6</option>
                        <option value="topic_7">Тематика 7</option>
                    </select>
                    <span class="btn type-3">Очистити</span>
                    <span class="btn type-1">Підібрати</span>
                </form>
            </div>
        </div>

        <div class="spacer-xl only-mobile"></div>

        <div class="sidebar-item notice">
            <div class="top-part">
                <div class="h3 light title-icon"><img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/info.svg')}}" alt="info">Оголошення</div>
            </div>
            <div class="bottom-part">
                <div class="text">
                    <p>В карточці туру ви можете дізнатись вільні дати, тривалість туру, а також потрібну кількість людей.</p>
                </div>
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/advertation.jpg')}}" alt="advert">
            </div>
        </div>

        <div class="sidebar-item overflow-hidden no-border">
            <div class="gift-certificate">
                <div class="bg" data-bg-src="{{asset('/img/gift-certificate.jpg')}}" style="background-image: url('{{asset('/img/preloader.png')}}');"></div>
                <div class="gift-icon">
                    <img src="{{asset('/icon/gift.svg')}}" alt="gift">
                </div>
                <div class="title h3 light">Подарунковий<br> сертифікат</div>
                <a href="#" class="full-size"></a>
            </div>
        </div>

        <div class="sidebar-item only-desktop">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/mailing.svg')}}" alt="mailing">
                    <span>Новини</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="news-links">
                    <div class="news-item">
                        <a href="#" class="title">Додано нову подорож «Шафран-тур на Драгобрат»</a>
                        <div class="news-date">22.11.2019</div>
                    </div>

                    <div class="news-item">
                        <a href="#" class="title">Оновлення дизайну сайту</a>
                        <div class="news-date">22.11.2019</div>
                    </div>

                    <div class="news-item">
                        <a href="#" class="title">Показ весільних суконь на Балу св. Валентина</a>
                        <div class="news-date">22.01.2020</div>
                    </div>
                </div>
                <a href="#" class="btn type-2">Показати всі новини</a>
            </div>
        </div>

        <div class="sidebar-item">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}" alt="reviews">
                    <span>Відгуки</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}" alt="user">
                        </div>
                        <div class="review-title">
                            <span class="h4">Григоряш Вероніка</span>
                            <span class="text text-sm">22.11.2019</span>
                            <span class="text text-sm">22:10</span>
                            <span class="stars select-stars stars-selected">
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star-empty"></i>
						</span>
                        </div>
                    </div>
                    <div class="text">
                        <p>Тур: <a href="#">Сиро-Винний тур Закарпатським та Прикарпатськими замками</a></p>
                        <p>Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще!</p>
                    </div>
                </div>

                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <span class="h4 full-size">КП</span>
                        </div>
                        <div class="review-title">
                            <span class="h4">Корнієнко Петро</span>
                            <span class="text text-sm">22.11.2019</span>
                            <span class="text text-sm">14:09</span>
                            <span class="stars select-stars stars-selected">
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star"></i>
							<i class="select-icon icon-star-empty"></i>
						</span>
                        </div>
                    </div>
                    <div class="text">
                        <p>Тур: <a href="#">10 родзинок Закарпаття</a></p>
                        <p>Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                    </div>
                </div>
                <a href="#" class="btn type-2 btn-block">Показати всі відгуки</a>
            </div>
        </div>

        <div class="sidebar-item">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/email.svg')}}" alt="mailing">
                    <span>Розсилка</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="subscribe-block">
                    <span class="btn type-2 open-popup" data-rel="tourists-mailing-popup">Я — турист</span>
                    <span class="btn type-2 open-popup" data-rel="agents-mailing-popup">Я — турагент</span>
                </div>
            </div>
        </div>
    </div>

</div>
