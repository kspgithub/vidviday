<div class="popup-wrap">
    <div class="bg-layer"></div>

    @include('includes.popups.call-back-popup')
    @include('includes.popups.write-message-popup')
    @include('includes.popups.tourists-mailing-popup')
    @include('includes.popups.agents-mailing-popup')
    @include('includes.popups.thanks-popup')
    @include('includes.popups.login-popup')

    <!-- PASSWORD RECOVERY POPUP -->
    <div class="popup-content" data-rel="password-recovery-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                        <div class="text-center">
                            <span class="h2 title text-medium">Відновлення паролю</span>
                            <br>
                            <span class="text">Ми надішлемо вам інструкцію для відновлення паролю на вашу електронну скриньку</span>
                        </div>
                        <div class="spacer-xs"></div>
                        <form action="/">
                            <label data-tooltip="Поле обов’язкове до заповнення">
                                <i>Email*</i>
                                <input type="text" name="email" required>
                            </label>
                            <a href="#" class="btn type-1 btn-block">Відновити пароль</a>
                        </form>
                        <div class="spacer-xs"></div>
                        <div class="text text-sm">* обов’язкове для заповнення поле</div>
                    </div>
                </div>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
            <div class="popup-footer">
                <span class="text">Назад до <span class="open-popup open-popup-link" data-rel="login-popup">входу</span></span>
            </div>
        </div>
    </div>
    <!-- PASSWORD RECOVERY POPUP END -->

    <!-- GALLERY POPUP -->
    <div class="popup-content" data-rel="gallery-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-3-new">
            <div class="popup-align">
                <div class="pagination-fraction">
                    <span class="text-bold">1</span> / <span>5</span>
                </div>
                <div class="swiper-entry popup-gallery-slider">
                    <div class="swiper-container" data-options='{
					"autoHeight": true,
					"lazy": true,
					"mousewheel": true
				}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/img_1.jpg')}}" alt="img 1" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <span class="text-md text-medium">Манявский скит</span>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img.jpg')}}" alt="banner img" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <span class="text-md text-medium">Манявский скит</span>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img_2.jpg')}}" alt="banner img 2" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <span class="text-md text-medium">Манявский скит</span>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img_7.jpg')}}" alt="banner img 7" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <span class="text-md text-medium">Манявский скит</span>
                            </div>

                            <div class="swiper-slide">
                                <img src="{{asset('img/preloader.png')}}" data-src="{{asset('img/banner-img_4.jpg')}}" alt="banner img 4" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                                <span class="text-md text-medium">Манявский скит</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev">
                        <i></i>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next">
                        <i></i>
                    </div>
                </div>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- GALLERY POPUP END -->

    <!-- ONE CLICK POPPUP -->
    <div class="popup-content" data-rel="one-click-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-align">
                <div class="text-center">
                    <span class="h2 title text-medium">Замовити в 1 клік</span>
                </div>
                <div class="spacer-xs"></div>
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
                            <i>Телефон*</i>
                            <input type="tel" name="tel" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Email*</i>
                            <input type="text" name="email" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="single-datepicker">
                            <div class="datepicker-input">
                                <span class="datepicker-placeholder">Оберіть дату</span>
                                <div class="datepicker-toggle">
                                    <div data-range="true" data-multiple-dates-separator=" - " class="datepicker-here" data-language="uk"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="number-input">
                            <span class="text-sm text-medium">Кількість осіб*</span>
                            <div class="number-input-btns">
                                <button type="button" class="decrement"></button>
                                <input type="number" step="1" value="1" min="1" max="999" readonly required>
                                <button type="button" class="increment"></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label>
                            <i>Коментар до замовлення</i>
                            <textarea></textarea>
                        </label>
                        <div class="text-center">
                            <span class="btn type-1 open-popup" data-rel="thanks-popup">Замовити</span>
                        </div>
                    </div>
                </form>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ONE CLICK POPPUP END -->

    <!-- TESTIMONIAL POPUP -->
    <div class="popup-content" data-rel="testimonial-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-header">
                <div class="text-center">
                    <span class="h2 title text-medium">Написати відгук</span>
                </div>
            </div>
            <div class="popup-align">
                <div class="have-an-account text-center">
                    <span class="text">Уже є аккаунт? <span class="open-popup" data-rel="login-popup">Вхід</span></span>

                    <div class="img-input-wrap">
                        <div class="img-input">
                            <input type="file">
                            <div class="text">
                                <span><b>Ваша фотографія</b> (перетягніть файл сюди або натисніть для вибору)</span>
                                <br>
                                <span>Це повинен бути файл формату <b>JPG/PNG, 200×200 пікс.</b>, розміром не більше <b>5 МБ</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/" class="row">
                    <div class="col-md-6 col-12">
                        <label data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваше ім’я*</i>
                            <input type="text" name="name" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваше прізвище</i>
                            <input type="text" name="surname">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваш телефон</i>
                            <input type="tel" name="tel">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Email</i>
                            <input type="text" name="email">
                        </label>
                    </div>

                    <div class="col-12">
					<span class="text text-sm">
						<b>Оцініть тур</b>
					</span>
                        <div class="stars select-stars rating-picker">
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
					<span class="text text-sm">
						<b>Тур у якому ви були</b>
					</span>
                        <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                            <option value="guid-0" selected disabled>Введіть назву чи оберіть зі списку</option>
                            <option value="guid-1" data-img="img/user.jpg">Тур 1</option>
                            <option value="guid-2" data-img="img/user.jpg">Тур 2</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
					<span class="text text-sm">
						<b>Ваш гід</b>
					</span>
                        <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                            <option value="guid-0" selected disabled>Оберіть зі списку</option>
                            <option value="guid-1" data-img="img/user.jpg">Христина Процишин</option>
                            <option value="guid-2" data-img="img/user.jpg">Марічка Касьянова (Михайлюсь)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="smile" data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваш відгук*</i>
                            <textarea required></textarea>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="img-input-wrap text-center-xs">
                            <div class="img-input tooltip-wrap">
                                <div class="tooltip">
                                    <span class="text-medium">Додати фото з туру:</span>
                                    <div class="text text-sm">
                                        <ul>
                                            <li>макс. розмір зображення 3 МБ</li>
                                            <li>макс. кількість зображень — 5</li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 text-right text-center-xs">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Залишити відгук</span>
                    </div>

                    <div class="text-center-xs col-12">
                        <div class="only-mobile spacer-sm"></div>
                        <span class="text-sm">* обов’язкове для заповнення поле</span>
                    </div>
                </form>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL POPUP END -->

    <!-- PLACE TESTIMONIAL POPUP -->
    <div class="popup-content" data-rel="place-testimonial-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-header">
                <div class="text-center">
                    <span class="h2 title text-medium">Написати відгук про місце</span>
                </div>
            </div>
            <div class="popup-align">
                <div class="have-an-account text-center">
                    <span class="text">Уже є аккаунт? <span class="open-popup" data-rel="login-popup">Вхід</span></span>

                    <div class="img-input-wrap">
                        <div class="img-input">
                            <input type="file">
                            <div class="text">
                                <span><b>Ваша фотографія</b> (перетягніть файл сюди або натисніть для вибору)</span>
                                <br>
                                <span>Це повинен бути файл формату <b>JPG/PNG, 200×200 пікс.</b>, розміром не більше <b>5 МБ</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/" class="row">
                    <div class="col-md-6 col-12">
                        <label data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваше ім’я*</i>
                            <input type="text" name="name" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваше прізвище</i>
                            <input type="text" name="surname">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваш телефон</i>
                            <input type="tel" name="tel">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Email</i>
                            <input type="text" name="email">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
					<span class="text text-sm">
						<b>Оцініть місце</b>
					</span>
                        <div class="stars select-stars rating-picker">
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                            <i class="select-icon icon-star-empty"></i>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
					<span class="text text-sm">
						<b>Тур, у якому Ви відвідували це місце</b>
					</span>
                        <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                            <option value="guid-0" selected disabled>Оберіть зі списку</option>
                            <option value="guid-1" data-img="img/user.jpg">Христина Процишин</option>
                            <option value="guid-2" data-img="img/user.jpg">Марічка Касьянова (Михайлюсь)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="smile" data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваш відгук*</i>
                            <textarea required></textarea>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="img-input-wrap text-center-xs">
                            <div class="img-input tooltip-wrap">
                                <div class="tooltip">
                                    <span class="text-medium">Додати фото з туру:</span>
                                    <div class="text text-sm">
                                        <ul>
                                            <li>макс. розмір зображення 3 МБ</li>
                                            <li>макс. кількість зображень — 5</li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 text-right text-center-xs">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Залишити відгук</span>
                    </div>

                    <div class="text-center-xs col-12">
                        <div class="only-mobile spacer-sm"></div>
                        <span class="text-sm">* обов’язкове для заповнення поле</span>
                    </div>
                </form>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- PLACE TESTIMONIAL POPUP END -->

    <!-- GUIDE TESTIMONIAL POPUP -->
    <div class="popup-content" data-rel="guide-testimonial-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-header">
                <div class="text-center">
                    <span class="h2 title text-medium">Залишити відгук про гіда</span>
                </div>
            </div>
            <div class="popup-align">
                <div class="have-an-account text-center">
                    <span class="text">Уже є аккаунт? <span class="open-popup" data-rel="login-popup">Вхід</span></span>

                    <div class="img-input-wrap">
                        <div class="img-input">
                            <input type="file">
                            <div class="text">
                                <span><b>Ваша фотографія</b> (перетягніть файл сюди або натисніть для вибору)</span>
                                <br>
                                <span>Це повинен бути файл формату <b>JPG/PNG, 200×200 пікс.</b>, розміром не більше <b>5 МБ</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/" class="row">
                    <div class="col-md-6 col-12">
                        <label data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваше ім’я*</i>
                            <input type="text" name="name" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваше прізвище</i>
                            <input type="text" name="surname">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваш телефон</i>
                            <input type="tel" name="tel">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Email</i>
                            <input type="text" name="email">
                        </label>
                    </div>

                    <div class="col-12">
					<span class="text text-sm">
						<b>Тур у якому ви були</b>
					</span>
                        <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                            <option value="guid-0" selected disabled>Введіть назву чи оберіть зі списку</option>
                            <option value="guid-1" data-img="img/user.jpg">Тур 1</option>
                            <option value="guid-2" data-img="img/user.jpg">Тур 2</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="smile" data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваш відгук*</i>
                            <textarea required></textarea>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="img-input-wrap text-center-xs">
                            <div class="img-input tooltip-wrap">
                                <div class="tooltip">
                                    <span class="text-medium">Додати фото з туру:</span>
                                    <div class="text text-sm">
                                        <ul>
                                            <li>макс. розмір зображення 3 МБ</li>
                                            <li>макс. кількість зображень — 5</li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 text-right text-center-xs">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Залишити відгук</span>
                    </div>

                    <div class="text-center-xs col-12">
                        <div class="only-mobile spacer-sm"></div>
                        <span class="text-sm">* обов’язкове для заповнення поле</span>
                    </div>
                </form>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- GUIDE TESTIMONIAL POPUP END -->

    <!-- MANAGER TESTIMONIAL POPUP -->
    <div class="popup-content" data-rel="manager-testimonial-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-header">
                <div class="text-center">
                    <span class="h2 title text-medium">Залишити відгук про менеджера</span>
                </div>
            </div>
            <div class="popup-align">
                <div class="have-an-account text-center">
                    <span class="text">Уже є аккаунт? <span class="open-popup" data-rel="login-popup">Вхід</span></span>

                    <div class="img-input-wrap">
                        <div class="img-input">
                            <input type="file">
                            <div class="text">
                                <span><b>Ваша фотографія</b> (перетягніть файл сюди або натисніть для вибору)</span>
                                <br>
                                <span>Це повинен бути файл формату <b>JPG/PNG, 200×200 пікс.</b>, розміром не більше <b>5 МБ</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/" class="row">
                    <div class="col-md-6 col-12">
                        <label data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваше ім’я*</i>
                            <input type="text" name="name" required>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваше прізвище</i>
                            <input type="text" name="surname">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Ваш телефон</i>
                            <input type="tel" name="tel">
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>
                            <i>Email</i>
                            <input type="text" name="email">
                        </label>
                    </div>

                    <div class="col-12">
					<span class="text text-sm">
						<b>Тур у якому ви були</b>
					</span>
                        <select class="custom-select" data-search="true" data-search-text="Введіть ім'я гіда">
                            <option value="guid-0" selected disabled>Введіть назву чи оберіть зі списку</option>
                            <option value="guid-1" data-img="img/user.jpg">Тур 1</option>
                            <option value="guid-2" data-img="img/user.jpg">Тур 2</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="smile" data-tooltip="Поле обов'язкове для заповнення">
                            <i>Ваш відгук*</i>
                            <textarea required></textarea>
                        </label>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="img-input-wrap text-center-xs">
                            <div class="img-input tooltip-wrap">
                                <div class="tooltip">
                                    <span class="text-medium">Додати фото з туру:</span>
                                    <div class="text text-sm">
                                        <ul>
                                            <li>макс. розмір зображення 3 МБ</li>
                                            <li>макс. кількість зображень — 5</li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 text-right text-center-xs">
                        <span class="btn type-1 open-popup" data-rel="thanks-popup">Залишити відгук</span>
                    </div>

                    <div class="text-center-xs col-12">
                        <div class="only-mobile spacer-sm"></div>
                        <span class="text-sm">* обов’язкове для заповнення поле</span>
                    </div>
                </form>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- MANAGER TESTIMONIAL POPUP END -->

    <!-- TOUR CANCEL POPUP -->
    <div class="popup-content" data-rel="tour-cancel-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-11 col-12">
                        <div class="text-center">
                            <span class="h2 title text-medium">Скасування Тур-відпустка «6 днів у зимових Карпатах»</span>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="text-center">
                            <span class="text">Зверніть будь ласка увагу на наші <a href="#">Умови скасування</a></span>
                        </div>
                        <div class="spacer-xs"></div>
                        <form action="/" class="row">

                            <div class="col-12">
                                <select>
                                    <option value="0" selected disabled>Причина скасування*</option>
                                    <option value="1">Причина скасування 1</option>
                                    <option value="2">Причина скасування 2</option>
                                    <option value="3">Причина скасування 3</option>
                                </select>

                                <label>
                                    <i>Примітка</i>
                                    <textarea></textarea>
                                </label>
                            </div>

                            <div class="col-12">
                                <span class="btn type-1 btn-block">Погоджуюсь на умови скасування</span>
                                <div class="text text-sm">* обов’язкове для заповнення поле</div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- TOUR CANCEL POPUP END -->

    <!-- TOUR CANCEL POPUP -->
    <div class="popup-content" data-rel="tour-cancel-popup-2">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-11 col-12">
                        <div class="text-center">
                            <span class="h2 title text-medium">Скасування Туру</span>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="text-center">
                            <span class="text">Зверніть будь ласка увагу на наші <a href="#">Умови скасування</a></span>
                        </div>
                        <div class="spacer-xs"></div>
                        <form action="/" class="row">

                            <div class="col-12">
                                <select>
                                    <option value="0" selected disabled>Причина скасування*</option>
                                    <option value="1">Причина скасування 1</option>
                                    <option value="2">Причина скасування 2</option>
                                    <option value="3">Причина скасування 3</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <span class="btn type-1 btn-block">Погоджуюсь на умови скасування</span>
                                <div class="text text-sm">* обов’язкове для заповнення поле</div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- TOUR CANCEL POPUP END -->

    <!-- VOICE SEARCH POPUP -->
    <div class="popup-content" data-rel="voice-search-popup">
        <div class="layer-close"></div>
        <div class="popup-container size-1">
            <div class="popup-align">
                <div class="img mic-icon">
                    <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/big-mic.svg')}}" alt="big mic">
                </div>
                <div class="text-center">
                    <span class="h2 title text-medium">Проговоріть фразу для пошуку</span>
                </div>
                <div class="voice-search-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="spacer-xs"></div>
                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- VOICE SEARCH POPUP END -->
</div>
