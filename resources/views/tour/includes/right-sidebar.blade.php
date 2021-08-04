<div class="right-sidebar">

    <div class="right-sidebar-inner">
        <div class="only-desktop">
            <div class="thumb-price">
                <span class="text">Ціна:<span>895</span><i>грн</i></span>
                <span class="discount">20 грн. <span class="tooltip-wrap red"><span class="tooltip text text-sm light">Знижка!</span></span></span>
            </div>

            <div>
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
                            <span>Поділитись:</span>
                            <a href="https://www.facebook.com/vidviday">
                                <svg width="8" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z"
                                        fill="#4267B2"/>
                                </svg>
                            </a>

                            <a href="https://twitter.com/vidviday">
                                <svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z"
                                        fill="#179CDE"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="add-to-like">
				<span class="icon">
					<svg width="26" height="25" viewBox="0 0 26 25" xmlns="http://www.w3.org/2000/svg"><path
                            d="M18.625.75C16.45.75 14.363 1.762 13 3.362 11.637 1.762 9.55.75 7.375.75 3.525.75.5 3.775.5 7.625.5 12.35 4.75 16.2 11.188 22.05L13 23.687l1.813-1.65C21.25 16.2 25.5 12.35 25.5 7.626c0-3.85-3.025-6.875-6.875-6.875zm-5.5 19.438l-.125.125-.125-.125C6.925 14.8 3 11.238 3 7.624c0-2.5 1.875-4.375 4.375-4.375 1.925 0 3.8 1.237 4.463 2.95h2.337c.65-1.713 2.525-2.95 4.45-2.95 2.5 0 4.375 1.875 4.375 4.375 0 3.613-3.925 7.175-9.875 12.563z"
                            stroke-linecap="round"/></svg>
				</span>
                <span class="text">
					<span>В улюблені</span>
					<span>В улюблених</span>
				</span>
                </div>
            </div>

            <div class="spacer-xs"></div>

            <form class="sidebar-item" action="{{route('tour.order', $tour)}}">
                <div class="single-datepicker">
                    <div class="datepicker-input">
                        <input id="selected-event-id" type="hidden" name="event_id" value="{{$nearest_event->id}}">
                        <span id="selected-event-title" class="datepicker-placeholder open-popup calendar-init"
                              data-rel="calendar-popup">{{$nearest_event->title}}</span>

                        <!-- <div class="datepicker-toggle">
                            <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                        </div> -->
                    </div>
                </div>
                <div class="thumb-info">
                    <span class="thumb-info-time text">2д / 1н</span>
                    <span class="thumb-info-people text">10+</span>
                </div>
                <a href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">Замовити Тур</a>
                <span class="btn type-2 btn-block open-popup" data-rel="one-click-popup">Замовити в 1 клік</span>
            </form>
        </div>

        <div class="spacer-xs"></div>

        <div class="sidebar-item notice">
            <div class="top-part">
                <div class="title h3 light title-icon"><img src="{{asset('/img/preloader.png')}}"
                                                            data-img-src="{{asset('/icon/headphones.svg')}}"
                                                            alt="headphones">Менеджер туру
                </div>
            </div>
            <div class="bottom-part">
                <span class="text-md text-medium">Кишенюк Василина</span>
                <div class="spacer-xs"></div>
                <div>
                    <a href="tel:+380978450651" class="text">+38 (097) 845 06 51</a>
                    <br>
                    <a href="tel:+380635064349" class="text">+38 (063) 506 43 49</a>
                    <div class="spacer-xs"></div>
                    <a href="mailto:vidviday.vasylyna@gmail.com" class="text">vidviday.vasylyna@gmail.com</a>
                </div>
                <div class="spacer-xs"></div>
                <div class="contact">
                    <div class="img">
                        <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/viber.svg')}}"
                             alt="viber">
                    </div>
                    <a href="viber:+380935115622">+38 (093) 511 56 22</a>
                </div>
                <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/manager.png')}}" alt="manager">
            </div>
        </div>

        <div class="sidebar-item only-desktop">
            <a href="{{asset('/document/document.pdf')}}" download class="download">
                <span class="text-md text-medium">Завантажити для друку</span>
            </a>
        </div>

        <div class="sidebar-item testimonials only-desktop">
            <div class="top-part b-border">
                <div class="title h3 title-icon">
                    <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                         alt="reviews">
                    <span>Відгуки</span>
                </div>
            </div>
            <div class="bottom-part">
                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/img/user.jpg')}}"
                                 alt="user">
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
                        <p>Чудовий тур! Отлимала безліч вражень, обов’язково спробую ще!</p>
                    </div>
                </div>

                <div class="review">
                    <div class="review-header">
                        <div class="review-img">
                            <span class="full-size h4">КП</span>
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
                        <p>Від туру залишились тільки позитивні емоції. Дякую організаторам!</p>
                    </div>
                </div>
                <a href="#testimonials" class="btn type-2 btn-block">Показати всі відгуки</a>
            </div>
        </div>

        <div class="only-mobile">
            <a href="{{route('tour.order', $tour)}}" class="btn type-1 btn-block">Замовити Тур</a>
        </div>
    </div>

</div>
