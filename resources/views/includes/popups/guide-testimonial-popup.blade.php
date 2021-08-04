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
